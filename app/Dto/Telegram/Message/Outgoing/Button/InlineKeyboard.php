<?php

declare(strict_types=1);

namespace App\Dto\Telegram\Message\Button;

class InlineKeyboard
{
    /**
     * @var InlineRow[]
     */
    private array $inlineRows = [];

    public function addInlineRow(InlineRow ...$rows): self
    {
        foreach ($rows as $row) {
            $this->inlineRows[] = $row;
        }

        return $this;
    }

    /**
     * @return InlineRow[]
     */
    public function getInlineRows(): array
    {
        return $this->inlineRows;
    }

    public function parseToArray(): array
    {
        $inlineKeyboard['inline_keyboard'] = [];

        foreach ($this->getInlineRows() as $inlineRow) {
            $inlineKeyboard['inline_keyboard'][] = $inlineRow->parseToArray();
        }

        return $inlineKeyboard;
    }
}
