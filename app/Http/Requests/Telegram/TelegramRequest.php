<?php

declare(strict_types=1);

namespace App\Http\Requests\Telegram;

use App\Dto\Telegram\Message\Incoming\Message;
use Illuminate\Foundation\Http\FormRequest;

class TelegramRequest extends FormRequest
{
    public function rules(): array
    {
        return [];
    }

    public function getDto(): Message
    {
        return (new Message())
            ->setChatId((string)$this->input('message.chat.id'))
            ->setChatType($this->input('message.chat.type'))
            ->setMessage($this->input('message.text'));
    }
}
