<?php

declare(strict_types=1);

namespace Iteks\OpenAi\Api\Assistants;

use Iteks\OpenAi\Contracts\Api\Assistants\VectorStoresInterface;
use Iteks\OpenAi\Contracts\Http\ApiClientInterface;

/**
 * Vector stores are used to store files for use by the `file_search` tool.
 *
 * @link https://platform.openai.com/docs/api-reference/vector-stores
 */
class VectorStores implements VectorStoresInterface
{
    private const ENDPOINT = 'vector_stores';

    public function __construct(
        private readonly ApiClientInterface $client,
    ) {}

    /**
     * Create a vector store.
     *
     * @param  array  $options  Additional options to pass to the API.
     * @return array A vector store object.
     *
     * @see https://platform.openai.com/docs/api-reference/vector-stores/object The vector store object.
     * @link https://platform.openai.com/docs/api-reference/vector-stores/create
     */
    public function create(array $options = []): array
    {
        $response = $this->client->request('post', self::ENDPOINT, $options);

        return $response->json();
    }

    /**
     * Returns a list of vector stores.
     *
     * @param  array  $options  Additional options to pass to the API.
     * @return array A list of vector store objects.
     *
     * @see https://platform.openai.com/docs/api-reference/vector-stores/object The vector store object.
     * @link https://platform.openai.com/docs/api-reference/vector-stores/list
     */
    public function list(array $options = []): array
    {
        $response = $this->client->request('get', self::ENDPOINT, $options);

        return $response->json();
    }

    /**
     * Retrieves a vector store.
     *
     * @param  string  $vector_store_id  The ID of the vector store to retrieve.
     * @return array The vector store object matching the specified ID.
     *
     * @see https://platform.openai.com/docs/api-reference/vector-stores/object The vector store object.
     * @link https://platform.openai.com/docs/api-reference/vector-stores/retrieve
     */
    public function retrieve(string $vector_store_id): array
    {
        $endpoint = self::ENDPOINT . "/{$vector_store_id}";

        $response = $this->client->request('get', $endpoint);

        return $response->json();
    }

    /**
     * Modifies a vector store.
     *
     * @param  string  $vector_store_id  The ID of the vector store to modify.
     * @param  array  $options  Additional options to pass to the API.
     * @return array The modified vector store object.
     *
     * @see https://platform.openai.com/docs/api-reference/vector-stores/object The vector store object.
     * @link https://platform.openai.com/docs/api-reference/vector-stores/modify
     */
    public function modify(string $vector_store_id, array $options = []): array
    {
        $endpoint = self::ENDPOINT . "/{$vector_store_id}";

        $response = $this->client->request('post', $endpoint, $options);

        return $response->json();
    }

    /**
     * Delete a vector store.
     *
     * @param  string  $vector_store_id  The ID of the vector store to delete.
     * @return array Deletion status.
     *
     * @link https://platform.openai.com/docs/api-reference/vector-stores/delete
     */
    public function delete(string $vector_store_id): array
    {
        $endpoint = self::ENDPOINT . "/{$vector_store_id}";

        $response = $this->client->request('delete', $endpoint);

        return $response->json();
    }
}
