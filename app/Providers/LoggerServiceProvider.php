<?php

declare(strict_types=1);

namespace App\Providers;

use App\Http\Controllers\Api\TelegramController;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\ServiceProvider;
use Psr\Log\LoggerInterface;

class LoggerServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->when(TelegramController::class)
            ->needs(LoggerInterface::class)
            ->give(function () {
                return Log::channel('telegram');
            });
    }
}
