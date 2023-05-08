<?php

declare(strict_types=1);

namespace App\Exceptions\Telegram;

use Exception;

class ParseModeException extends Exception
{
    /**
     * Render the exception as an HTTP response.
     *
     * @return false
     */
    public function render(): bool
    {
        $this->message = "Parse Mode Error: {$this->getMessage()}";

        return false;
    }
}
