<?php

declare(strict_types=1);

namespace App\Factory\Telegram\MessageProcessing\Content;

use App\Telegram\Prepare\Content\HTMLMode;
use App\Telegram\Prepare\Content\Markdown2Mode;
use App\Telegram\Prepare\Content\MarkdownMode;
use App\Telegram\Prepare\Content\PrepareByMode;
use App\Telegram\TelegramMessage;
use Illuminate\Contracts\Container\BindingResolutionException;

class ContentProcessingByParseMode
{
    /**
     * @var PrepareByMode[] $handlerByParseMode
     */
    private array $handlerByParseMode = [
        TelegramMessage::PARSE_MODE['html'] => HTMLMode::class,
        TelegramMessage::PARSE_MODE['markdown'] => MarkdownMode::class,
        TelegramMessage::PARSE_MODE['markdown2'] => Markdown2Mode::class,
    ];

    /**
     * @throws BindingResolutionException
     */
    public function setHandler(string $parseMode): PrepareByMode
    {
        return app()->make($this->handlerByParseMode[$parseMode]);
    }
}
