<?php

declare(strict_types=1);

namespace Iteks\Contracts\Http;

use Illuminate\Http\Client\Response;

interface ClientInterface
{
    public function request(string $method, string $uri, array $data = [], array $attachments = [], array $headers = []): Response;
}
