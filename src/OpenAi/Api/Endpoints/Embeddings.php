<?php

declare(strict_types=1);

namespace Iteks\OpenAi\Api\Endpoints;

use Iteks\OpenAi\Contracts\Api\Endpoints\EmbeddingsInterface;
use Iteks\OpenAi\Contracts\Http\ApiClientInterface;

/**
 * Get a vector representation of a given input that can be easily consumed by machine learning models and algorithms.
 *
 * @link https://platform.openai.com/docs/api-reference/embeddings
 */
class Embeddings implements EmbeddingsInterface
{
    private const ENDPOINT = 'embeddings';

    public function __construct(
        private readonly ApiClientInterface $client,
    ) {
    }

    /**
     * Creates an embedding vector representing the input text.
     *
     * @param  string  $input  Input text to embed, encoded as a string or array of tokens. To embed multiple inputs in a single request, pass an array of strings or array of token arrays. The input must not exceed the max input tokens for the model (8192 tokens for `text-embedding-ada-002`), cannot be an empty string, and any array must be 2048 dimensions or less.
     * @param  string  $model  ID of the model to use.
     * @param  array  $options  Additional options to pass to the API.
     * @return array A list of embedding objects.
     *
     * @see https://platform.openai.com/docs/api-reference/embeddings/object The embedding object.
     * @link https://platform.openai.com/docs/api-reference/embeddings/create
     */
    public function create(string $input, string $model, array $options = []): array
    {
        $options = array_merge([
            'input' => $input,
            'model' => $model,
        ], $options);

        $response = $this->client->request('post', self::ENDPOINT, $options);

        return $response->json();
    }
}
