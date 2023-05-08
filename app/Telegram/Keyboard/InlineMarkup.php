<?php

declare(strict_types=1);

namespace App\Telegram\Keyboard;

use App\Dto\Telegram\Message\Button\InlineButton;
use App\Dto\Telegram\Message\Button\InlineKeyboard;
use App\Dto\Telegram\Message\Button\InlineRow;

trait InlineMarkup
{
    /**
     * @var InlineRow[]
     */
    private array $inlineRows;

    private int $rowKey = 0;

    public function addButton(string $text, string $url): self
    {
        if (empty($this->inlineRows[$this->rowKey])) {
            $this->inlineRows[$this->rowKey] = new InlineRow();
        }

        $this->inlineRows[$this->rowKey]->addInlineButton(
            (new InlineButton())
                ->setText($text)
                ->setUrl($url)
        );

        return $this;
    }

    public function addCallbackButton(string $text, array $data): self
    {
        if (empty($this->inlineRows[$this->rowKey])) {
            $this->inlineRows[$this->rowKey] = new InlineRow();
        }

        $this->inlineRows[$this->rowKey]->addInlineButton(
            (new InlineButton())
                ->setText($text)
                ->setCallbackData($data)
        );

        return $this;
    }

    public function addButtonANewLine(string $text, string $url): self
    {
        $this->rowKey++;

        return $this->addButton($text, $url);
    }

    public function addCallbackButtonANewLine(string $text, array $data): self
    {
        $this->rowKey++;

        return $this->addCallbackButton($text, $data);
    }

    public function newButtonsLine(): self
    {
        $this->rowKey++;

        return $this;
    }

    public function hasKeyboard(): bool
    {
        return isset($this->inlineRows);
    }

    public function keyboardToArray(): array
    {
        $keyboard = new InlineKeyboard();

        foreach ($this->inlineRows as $inlineRow) {
            $keyboard->addInlineRow($inlineRow);
        }

        return $keyboard->parseToArray();
    }
}
