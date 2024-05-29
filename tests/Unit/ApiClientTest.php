<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Http;
use Iteks\Http\Client;
use Iteks\Http\Exceptions\AuthenticationException;
use Iteks\Http\Exceptions\RateLimitException;
use Iteks\Http\Exceptions\RequestException;
use Iteks\OpenAi\Api\Endpoints\Chat;
use Iteks\OpenAi\Api\Endpoints\Models;
use Iteks\OpenAi\Http\ApiClient;

describe('Api Client', function () {
    beforeEach(function () {
        $this->httpClient = new Client(config('openai.api_key'));
        $this->apiClient = new ApiClient($this->httpClient);
    });

    afterEach(function () {
        // Clear resolved HTTP instances to ensure clean state
        Http::clearResolvedInstances();
    });

    it('has chat', function () {
        expect($this->apiClient->chat())->toBeInstanceOf(Chat::class);
    });

    it('has models', function () {
        expect($this->apiClient->models())->toBeInstanceOf(Models::class);
    });

    it('makes a successful request to the models endpoint', function () {
        Http::fake([
            'https://api.openai.com/v1/models' => Http::response(['data' => 'test'], 200),
        ]);

        $response = $this->apiClient->request('get', 'models');

        expect($response->successful())->toBeTrue();
        expect($response->json())->toBe(['data' => 'test']);
    });

    it('handles AuthenticationException on 401 response', function () {
        Http::fake([
            'https://api.openai.com/v1/models' => Http::response(['error' => 'Unauthorized'], 401),
        ]);

        expect(fn () => $this->apiClient->request('get', 'models'))
            ->toThrow(AuthenticationException::class);
    });

    it('handles RateLimitException on 429 response', function () {
        Http::fake([
            'https://api.openai.com/v1/models' => Http::response(['error' => 'Rate limit exceeded'], 429),
        ]);

        expect(fn () => $this->apiClient->request('get', 'models'))
            ->toThrow(RateLimitException::class);
    });

    it('handles RequestException on 500 response', function () {
        Http::fake([
            'https://api.openai.com/v1/models' => Http::response(['error' => 'Server error'], 500),
        ]);

        expect(fn () => $this->apiClient->request('get', 'models'))
            ->toThrow(RequestException::class);
    });

})->group('api-client');
