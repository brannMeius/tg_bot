<?php

declare(strict_types=1);

namespace App\Telegram\Data;

use App\Telegram\Actions\CreateMessage;

trait BasicData
{
    /**
     * @var int[]|string[]
     */
    private array $chatIds;

    private string $content;

    /**
     * @param int|string|array $chatId
     */
    public function to($chatId): self
    {
        if (!is_array($chatId)) {
            return $this->addChatId($chatId);
        }

        return $this->addChatIds($chatId);
    }

    /**
     * @param int|string $chatId
     * @return CreateMessage
     */
    public function addChatId($chatId): self
    {
        $this->chatIds[] = $chatId;

        return $this;
    }

    public function addChatIds(array $chatIds): self
    {
        foreach ($chatIds as $chatId) {
            $this->chatIds[] = $chatId;
        }

        return $this;
    }

    /**
     * @param int[]|string[] $chatIds
     */
    public function setChatIds(array $chatIds): self
    {
        $this->chatIds = $chatIds;

        return $this;
    }

    public function setContent(string $content): self
    {
        $this->content = trim($content);

        return $this;
    }

    public function addContent(string $content): self
    {
        $this->content .= $content;

        return $this;
    }
}
