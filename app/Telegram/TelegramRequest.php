<?php

declare(strict_types=1);

namespace App\Telegram;

use App\Telegram\Actions\Message;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Pool;
use GuzzleHttp\Psr7\Response;

class TelegramRequest
{
    private Client $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function handle(Message $message): array
    {
        $pool = new Pool($this->client, $message->getRequests(), [
            'concurrency' => 4,
            'fulfilled' => function (Response $response) use (&$result) {
                $body = $response->getBody();
                $result[] = json_decode($body->getContents(), true);
            },
            'rejected' => function (RequestException $reason) {
                throw $reason;
            },
        ]);
        $promise = $pool->promise();

        $promise->wait();

        return $result;
    }
}
