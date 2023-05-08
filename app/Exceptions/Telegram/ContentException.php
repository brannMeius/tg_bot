<?php

declare(strict_types=1);

namespace App\Exceptions\Telegram;

use Exception;

class ContentException extends Exception
{
    /**
     * Render the exception as an HTTP response.
     *
     * @return false
     */
    public function render(): bool
    {
        $this->message = "Content Error: {$this->getMessage()}";

        return false;
    }
}
