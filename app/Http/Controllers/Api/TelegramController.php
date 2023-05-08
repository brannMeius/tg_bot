<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Telegram\TelegramRequest;
use App\Strategy\Telegram\Message as MessageFactory;
use Illuminate\Http\JsonResponse;
use Psr\Log\LoggerInterface;

class TelegramController extends Controller
{
    private LoggerInterface $logger;

    private MessageFactory $messageFactory;

    public function __construct(
        LoggerInterface $logger,
        MessageFactory  $messageFactory
    ) {
        $this->logger = $logger;
        $this->messageFactory = $messageFactory;
    }

    public function __invoke(TelegramRequest $request): JsonResponse
    {
        $dto = $request->getDto();

        $this->logger->info('data:', $request->all());
        try {
            $handler = $this->messageFactory->setHandler($request->getDto());

            $handler->handle($dto);
        } catch (\Throwable $exception) {
            $this->logger->error('data:', [
                'error' => $exception->getMessage(),
                'request' => $request->all(),
            ]);
        }

        return response()->json([]);
    }
}
