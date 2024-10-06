<?php

declare(strict_types=1);

namespace Iteks\OpenAi\Http;

use Illuminate\Http\Client\Response;
use Iteks\Contracts\Http\ClientInterface;
use Iteks\Http\Exceptions\AuthenticationException;
use Iteks\Http\Exceptions\RateLimitException;
use Iteks\Http\Exceptions\RequestException;
use Iteks\OpenAi\Api\Assistants\Assistants;
use Iteks\OpenAi\Api\Assistants\Messages;
use Iteks\OpenAi\Api\Assistants\Runs;
use Iteks\OpenAi\Api\Assistants\RunSteps;
use Iteks\OpenAi\Api\Assistants\Threads;
use Iteks\OpenAi\Api\Assistants\VectorStoreFileBatches;
use Iteks\OpenAi\Api\Assistants\VectorStoreFiles;
use Iteks\OpenAi\Api\Assistants\VectorStores;
use Iteks\OpenAi\Api\Endpoints\Audio;
use Iteks\OpenAi\Api\Endpoints\Batch;
use Iteks\OpenAi\Api\Endpoints\Chat;
use Iteks\OpenAi\Api\Endpoints\Embeddings;
use Iteks\OpenAi\Api\Endpoints\Files;
use Iteks\OpenAi\Api\Endpoints\FineTuning;
use Iteks\OpenAi\Api\Endpoints\Images;
use Iteks\OpenAi\Api\Endpoints\Models;
use Iteks\OpenAi\Api\Endpoints\Moderations;
use Iteks\OpenAi\Api\Legacy\Completions;
use Iteks\OpenAi\Contracts\Http\ApiClientInterface;

class ApiClient implements ApiClientInterface
{
    protected string $apiKey;

    protected string $baseUri;

    public function __construct(protected ClientInterface $client)
    {
        $this->apiKey = config('openai.api_key');
        $this->baseUri = config('openai.base_uri');
    }

    public function request(string $method, string $uri, array $data = [], array $attachments = [], array $headers = []): Response
    {
        /** @var string[] $betaEndpoints */
        $betaEndpoints = config('openai.beta_endpoints', ['assistants', 'threads', 'vector_stores']);

        if (collect($betaEndpoints)->first(fn ($endpoint) => str_contains($uri, $endpoint))) {
            $headers['OpenAI-Beta'] = 'assistants=v2';
        }

        $response = $this->client->request($method, "{$this->baseUri}/{$uri}", $data, $attachments, $headers);

        if (! $response->successful()) {
            $this->handleError($response);
        }

        return $response;
    }

    protected function handleError(Response $response): void
    {
        switch ($response->status()) {
            case 401:
                throw new AuthenticationException;
            case 429:
                throw new RateLimitException;
            default:
                throw new RequestException('OpenAI API request failed: ' . $response->body(), $response->status());
        }
    }

    public function audio(): Audio
    {
        return new Audio($this);
    }

    public function chat(): Chat
    {
        return new Chat($this);
    }

    public function embeddings(): Embeddings
    {
        return new Embeddings($this);
    }

    public function fineTuning(): FineTuning
    {
        return new FineTuning($this);
    }

    public function batch(): Batch
    {
        return new Batch($this);
    }

    public function files(): Files
    {
        return new Files($this);
    }

    public function images(): Images
    {
        return new Images($this);
    }

    public function models(): Models
    {
        return new Models($this);
    }

    public function moderations(): Moderations
    {
        return new Moderations($this);
    }

    public function assistants(): Assistants
    {
        return new Assistants($this);
    }

    public function threads(): Threads
    {
        return new Threads($this);
    }

    public function messages(): Messages
    {
        return new Messages($this);
    }

    public function runs(): Runs
    {
        return new Runs($this);
    }

    public function runSteps(): RunSteps
    {
        return new RunSteps($this);
    }

    public function vectorStores(): VectorStores
    {
        return new VectorStores($this);
    }

    public function vectorStoreFiles(): VectorStoreFiles
    {
        return new VectorStoreFiles($this);
    }

    public function vectorStoreFileBatches(): VectorStoreFileBatches
    {
        return new VectorStoreFileBatches($this);
    }

    public function completions(): Completions
    {
        return new Completions($this);
    }
}
