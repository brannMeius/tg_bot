<?php

namespace App\Telegram\Prepare\Content;

interface PrepareByMode
{
    public function handle(string $content): string;
}
