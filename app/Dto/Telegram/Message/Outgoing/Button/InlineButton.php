<?php

declare(strict_types=1);

namespace App\Dto\Telegram\Message\Button;

class InlineButton
{
    const CALLBACK_BUTTON = 0;

    const URL_BUTTON = 1;

    private int $type;

    private string $text;

    private ?string $url = null;

    private ?string $callbackData = null;

    public function getText(): string
    {
        return $this->text;
    }

    public function setText(string $text): self
    {
        $this->text = $text;

        return $this;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(string $url): self
    {
        $this->type = self::URL_BUTTON;
        $this->url = $url;

        return $this;
    }

    public function getCallbackData(): ?string
    {
        return $this->callbackData;
    }

    public function setCallbackData(array $callbackData): self
    {
        $this->type = self::CALLBACK_BUTTON;
        $this->callbackData = json_encode($callbackData);

        return $this;
    }

    public function parseToArray(): array
    {
        if ($this->type === self::URL_BUTTON) {
            return [
                'text' => $this->getText(),
                'url' => $this->getUrl(),
            ];
        }

        return [
            'text' => $this->getText(),
            'callback_data' => $this->getCallbackData(),
        ];
    }
}
