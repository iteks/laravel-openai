<?php

declare(strict_types=1);

namespace Iteks\Http;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Iteks\Contracts\Http\ClientInterface;

class Client implements ClientInterface
{
    public function __construct(
        private readonly string $apiKey,
    ) {
    }

    public function request(string $method, string $uri, array $data = [], array $attachments = [], array $headers = []): Response
    {
        try {
            $http = Http::withHeaders(array_merge([
                'Authorization' => 'Bearer ' . $this->apiKey,
            ], $headers));

            if (! empty($attachments)) {
                $http = $this->attachFiles($http, $attachments);
            }

            return $http->$method($uri, $data);
        } catch (ConnectionException $e) {
            throw new ConnectionException('Could not resolve host', 0, $e);
        }
    }

    private function attachFiles(PendingRequest $http, array $attachments): PendingRequest
    {
        $http = $http->asMultipart();

        foreach ($attachments as $key => $value) {
            $http = $http->attach($key, $value);
        }

        return $http;
    }
}
