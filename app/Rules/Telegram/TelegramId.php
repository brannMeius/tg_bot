<?php

declare(strict_types=1);

namespace App\Rules\Telegram;

use Illuminate\Contracts\Validation\Rule;

class TelegramId implements Rule
{
    public const GROUP_TYPE = 'group';

    public const CHANNEL_TYPE = 'channel';

    public const USER_TYPE = 'user';

    private array $rulesTgChatType = [
        self::GROUP_TYPE => '/^(-[0-9]{6,15})$/',
        self::CHANNEL_TYPE => '/^(-[0-9]{9,15})$/',
        self::USER_TYPE => '/^([0-9]{6,11})$/',
    ];

    private array $tgChatType;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct(array $tgChatType = [TelegramId::GROUP_TYPE, TelegramId::CHANNEL_TYPE, TelegramId::USER_TYPE])
    {
        $this->tgChatType = $tgChatType;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value): bool
    {
        foreach ($this->tgChatType as $type) {
            if (empty($this->rulesTgChatType[$type])) {
                continue;
            }

            if (preg_match($this->rulesTgChatType[$type], $value)) {
                return true;
            }
        }

        return false;
    }

    /**
     * Get the validation error message.
     *
     * @return void
     */
    public function message()
    {
    }
}
