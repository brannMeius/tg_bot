<?php

declare(strict_types=1);

namespace App\Strategy\Telegram;

use App\Dto\Telegram\Message\Incoming\Message as MessageDto;
use App\Factory\Telegram\ChatType;
use Exception;

class Message
{
    private ChatType $chatTypeFactory;

    public function __construct(ChatType $chatTypeFactory)
    {
        $this->chatTypeFactory = $chatTypeFactory;
    }

    /**
     * @throws Exception
     */
    public function setHandler(MessageDto $message): \App\Service\Telegram\TelegramMessage
    {
        return $this->chatTypeFactory->getHandler($message->getChatType());
    }
}
