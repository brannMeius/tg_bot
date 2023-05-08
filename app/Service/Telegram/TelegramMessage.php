<?php

namespace App\Service\Telegram;

use App\Dto\Telegram\Message\Incoming\Message;

interface TelegramMessage
{
    public function handle(Message $message);
}
