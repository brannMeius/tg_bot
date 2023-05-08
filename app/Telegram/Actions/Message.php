<?php

declare(strict_types=1);

namespace App\Telegram\Actions;

use App\Telegram\TelegramRequest;

abstract class Message
{
    private TelegramRequest $telegramRequest;

    public function __construct(TelegramRequest $telegramRequest)
    {
        $this->telegramRequest = $telegramRequest;
    }

    abstract public function getRequests(): \Generator;

    public function send(): array
    {
        return $this->telegramRequest->handle($this);
    }
}
