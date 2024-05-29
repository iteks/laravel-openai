<?php

declare(strict_types=1);

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Http;
use Iteks\Http\Client;
use Iteks\OpenAi\Http\ApiClient;

describe('Http Client', function () {
    beforeEach(function () {
        $this->httpClient = new Client(config('openai.api_key'));
        $this->apiClient = new ApiClient($this->httpClient);
    });

    afterEach(function () {
        // Clear resolved HTTP instances to ensure clean state
        Http::clearResolvedInstances();
    });

    it('makes a successful GET request', function () {
        Http::fake([
            'https://api.openai.com/v1/models' => Http::response(['data' => 'test'], 200),
        ]);

        $response = $this->apiClient->request('get', 'models');

        expect($response->successful())->toBeTrue();
        expect($response->json())->toBe(['data' => 'test']);
    });

    it('throws ConnectException on connection error', function () {
        Http::fake(function () {
            throw new ConnectionException('Could not resolve host');
        });

        expect(fn () => $this->apiClient->request('get', 'models'))
            ->toThrow(ConnectionException::class);
    });
})->group('http-client');
