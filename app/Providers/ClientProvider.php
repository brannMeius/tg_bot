<?php

declare(strict_types=1);

namespace App\Providers;

use App\Console\Commands\SetTelegramWebhook;
use App\Telegram\TelegramRequest;
use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use Illuminate\Support\ServiceProvider;

class ClientProvider extends ServiceProvider
{
    private array $telegramClasses = [
        SetTelegramWebhook::class,
        TelegramRequest::class,
    ];

    /** Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->when($this->telegramClasses)
            ->needs(ClientInterface::class)
            ->give(function () {
                $link = 'https://api.telegram.org/bot' . config('telegram.token') . '/';
                return new Client([
                    'base_uri' => $link,
                ]);
            });
    }
}
