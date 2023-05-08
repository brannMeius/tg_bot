<?php

declare(strict_types=1);

namespace App\Dto\Telegram\Message\Incoming;

class Message
{
    private string $chat_type;

    private string $message;

    private string $chat_id;

    public function setChatType(string $chat_type): self
    {
        $this->chat_type = $chat_type;

        return $this;
    }

    public function getChatType(): string
    {
        return $this->chat_type;
    }

    public function setMessage(string $message): self
    {
        $this->message = $message;

        return $this;
    }

    public function getMessage(): string
    {
        return $this->message;
    }

    public function setChatId(string $chat_id): self
    {
        $this->chat_id = $chat_id;

        return $this;
    }

    public function getChatId(): string
    {
        return $this->chat_id;
    }
}
