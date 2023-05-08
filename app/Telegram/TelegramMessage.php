<?php

declare(strict_types=1);

namespace App\Telegram;

use App\Telegram\Actions\CreateMessage;

class TelegramMessage
{
    private CreateMessage $createMessage;

    public function __construct(CreateMessage $createMessage)
    {
        $this->createMessage = $createMessage;
    }

    public const PARSE_MODE = [
        'html' => 'HTML',
        'markdown' => 'Markdown',
        'markdown2' => 'MarkdownV2',
    ];

    public const NOTIFICATION_OFF = true;

    public const NOTIFICATION_ON = false;

    public function create(): CreateMessage
    {
        return $this->createMessage;
    }
}
