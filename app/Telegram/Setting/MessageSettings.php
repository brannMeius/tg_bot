<?php

declare(strict_types=1);

namespace App\Telegram\Setting;

use App\Exceptions\Telegram\ParseModeException;
use App\Telegram\TelegramMessage;

trait MessageSettings
{
    private string $parseMode = TelegramMessage::PARSE_MODE['markdown2'];

    /**
     * Maximum number of characters in a message.
     * @var int $sizeMessage
     */
    private int $sizeMessage = 4096;

    private bool $disableNotification = TelegramMessage::NOTIFICATION_ON;

    /**
     * @throws ParseModeException
     */
    public function setParseMode(string $parseMode): self
    {
        if (!in_array($parseMode, TelegramMessage::PARSE_MODE)) {
            throw new ParseModeException('Invalid value specified.');
        }

        $this->parseMode = $parseMode;

        return $this;
    }

    public function setSizeMessage(int $sizeMessage): self
    {
        $this->sizeMessage = $sizeMessage;

        return $this;
    }

    public function disableNotification(bool $disableNotification = TelegramMessage::NOTIFICATION_OFF): self
    {
        $this->disableNotification = $disableNotification;

        return $this;
    }
}
