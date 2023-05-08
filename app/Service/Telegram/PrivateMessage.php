<?php

declare(strict_types=1);

namespace App\Service\Telegram;

use App\Dto\Telegram\Message\Incoming\Message;

class PrivateMessage implements TelegramMessage
{
    private \App\Telegram\TelegramMessage $telegramMessage;

    public function __construct(\App\Telegram\TelegramMessage $telegramMessage)
    {
        $this->telegramMessage = $telegramMessage;
    }

    public function handle(Message $message): array
    {
        return $this->telegramMessage
            ->create()
            ->to($message->getChatId())
            ->setContent('Message received successfully.')
            ->send();
    }
}
