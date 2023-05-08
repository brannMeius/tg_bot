<?php

declare(strict_types=1);

namespace App\Dto\Telegram\Message\Button;

class InlineRow
{
    /**
     * @var InlineButton[]
     */
    private array $inlineButtons = [];

    public function addInlineButton(InlineButton ...$buttons): self
    {
        foreach ($buttons as $button) {
            $this->inlineButtons[] = $button;
        }

        return $this;
    }

    /**
     * @return InlineButton[]
     */
    public function getInlineButtons(): array
    {
        return $this->inlineButtons;
    }

    public function parseToArray(): array
    {
        $inlineRow = [];

        foreach ($this->getInlineButtons() as $inlineButton) {
            $inlineRow[] = $inlineButton->parseToArray();
        }

        return $inlineRow;
    }
}
