<?php

declare(strict_types=1);

namespace App\Telegram\Prepare\Content;

class Markdown2Mode implements PrepareByMode
{
    public function handle(string $content): string
    {
        return preg_replace('/([-_*\[\]()~`>#+=|{}.!])/', "\\\\$1", $content);
    }
}
