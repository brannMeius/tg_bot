<?php

declare(strict_types=1);

namespace App\Telegram\Actions;

use App\Exceptions\Telegram\ChatIdException;
use App\Exceptions\Telegram\ContentException;
use App\Factory\Telegram\MessageProcessing\Content\ContentProcessingByParseMode;
use App\Rules\Telegram\TelegramId;
use App\Telegram\Data\BasicData;
use App\Telegram\Keyboard\InlineMarkup;
use App\Telegram\Setting\MessageSettings;
use App\Telegram\TelegramRequest;
use GuzzleHttp\Psr7\Request;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Support\Arr;

class CreateMessage extends Message
{
    use InlineMarkup, MessageSettings, BasicData;

    const SEND_MESSAGE_URL = 'https://api.telegram.org/bot%s/sendMessage?';

    private string $token;

    private TelegramId $idRules;

    public function __construct(TelegramRequest $telegramRequest)
    {
        parent::__construct($telegramRequest);
        $this->token = (string)config('telegram.token');
        $this->idRules = new TelegramId();
    }

    /**
     * @throws ChatIdException|BindingResolutionException
     * @throws ContentException
     */
    public function getRequests(): \Generator
    {
        if (empty($this->content)) {
            throw new ContentException('Content not specified');
        }

        $url = sprintf(self::SEND_MESSAGE_URL, $this->token);
        $payload = $this->getPayload();

        foreach ($this->chatIds as $chatId) {
            if (false === $this->idRules->passes('id', $chatId)) {
                throw new ChatIdException("Chat ID: {$chatId} - does not comply with the rules");
            }

            $payload['chat_id'] = $chatId;
            $uri = $url . Arr::query($payload);

            yield new Request('POST', $uri);
        }
    }

    /**
     * @throws BindingResolutionException
     */
    private function getPayload(): array
    {
        $payload = [
            'text' => (new ContentProcessingByParseMode())->setHandler($this->parseMode)->handle($this->content),
            'parse_mode' => $this->parseMode,
            'disable_notification' => $this->disableNotification,
        ];

        if ($this->hasKeyboard()) {
            $payload['reply_markup'] = json_encode($this->keyboardToArray());
        }

        return $payload;
    }
}
