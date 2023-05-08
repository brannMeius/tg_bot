<?php

declare(strict_types=1);

namespace App\Factory\Telegram;

use App\Service\Telegram\PrivateMessage;
use App\Service\Telegram\TelegramMessage;
use Exception;

class ChatType
{
    public const PRIVATE = 'private';

    public const GROUP = 'group';

    public const SUPERGROUP = 'supergroup';

    private array $handlerByType = [
        self::PRIVATE => PrivateMessage::class,
    ];

    /**
     * @throws Exception
     */
    public function getHandler(string $type): TelegramMessage
    {
        if (empty($this->handlerByType[$type])) {
            throw new Exception(__METHOD__ . 'Unable to process message.');
        }

        return app()->make($this->handlerByType[$type]);
    }
}
