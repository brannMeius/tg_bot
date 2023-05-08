<?php

namespace App\Console\Commands;

use Exception;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Console\Command;
use Illuminate\Routing\UrlGenerator;
use Illuminate\Support\Str;
use Throwable;

class SetTelegramWebhook extends Command
{
    protected $signature = 'set:webhook';

    protected $description = 'Forwarding bot requests to the server';

    private ClientInterface $client;

    public function __construct(ClientInterface $client)
    {
        parent::__construct();
        $this->client = $client;
    }

    /**
     * install webhook for Telegram API.
     *
     * @param UrlGenerator $url
     * @return int
     */
    public function handle(UrlGenerator $url): int
    {
        try {
            $this->client->request('GET', 'setWebhook', [
                'query' => [
                    'url' => $this->setUrl($url)
                ]
            ]);
        } catch (GuzzleException | Throwable $exception) {
            self::error($exception->getMessage());

            return self::FAILURE;
        }

        return self::SUCCESS;
    }

    /**
     * Return link for webhook.
     *
     * @param UrlGenerator $url
     * @return string
     * @throws Exception
     */
    private function setUrl(UrlGenerator $url): string
    {
        $url = $url->route('telegram.handle');

        if (1 !== preg_match('%^(https://)%', $url)) {
            throw new Exception('Telegram can only make requests using an HTTPS certificate.');
        }

        if (false === app()->environment('production')) {
            $basic_data = config('server.basic_auth.login') . ":" . config('server.basic_auth.password') . "@";
            $url = Str::substrReplace($url, $basic_data, 8, 0);
        }

        return $url;
    }
}
