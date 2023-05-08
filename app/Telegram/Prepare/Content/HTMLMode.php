<?php

declare(strict_types=1);

namespace App\Telegram\Prepare\Content;

class HTMLMode implements PrepareByMode
{
    public function handle(string $content): string
    {
        return $content;
    }
}
