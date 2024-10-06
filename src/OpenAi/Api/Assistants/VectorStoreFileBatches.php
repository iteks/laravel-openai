<?php

declare(strict_types=1);

namespace Iteks\OpenAi\Api\Assistants;

use Iteks\OpenAi\Contracts\Api\Assistants\VectorStoreFileBatchesInterface;
use Iteks\OpenAi\Contracts\Http\ApiClientInterface;

/**
 * Vector store file batches represent operations to add multiple files to a vector store.
 *
 * @link https://platform.openai.com/docs/api-reference/vector-stores-file-batches
 */
class VectorStoreFileBatches implements VectorStoreFileBatchesInterface
{
    private const ENDPOINT = 'vector_stores';

    public function __construct(
        private readonly ApiClientInterface $client,
    ) {}

    /**
     * Create a vector store file batch.
     *
     * @param  string  $vector_store_id  The ID of the vector store for which to create a File Batch.
     * @param  array  $file_ids  A list of File IDs that the vector store should use. Useful for tools like file_search that can access files.
     * @return array A vector store file batch object.
     *
     * @see https://platform.openai.com/docs/api-reference/vector-stores-file-batches/batch-object The vector store files batch object.
     * @link https://platform.openai.com/docs/api-reference/vector-stores-file-batches/createBatch
     */
    public function create(string $vector_store_id, array $file_ids): array
    {
        $endpoint = self::ENDPOINT . "/{$vector_store_id}/file_batches";

        $response = $this->client->request('post', $endpoint, ['file_ids' => $file_ids]);

        return $response->json();
    }

    /**
     * Retrieves a vector store file batch.
     *
     * @param  string  $vector_store_id  The ID of the vector store that the file batch belongs to.
     * @param  string  $batch_id  The ID of the file batch being retrieved.
     * @return array The vector store file batch object.
     *
     * @see https://platform.openai.com/docs/api-reference/vector-stores-file-batches/batch-object The vector store files batch object.
     * @link https://platform.openai.com/docs/api-reference/vector-stores-file-batches/getBatch
     */
    public function retrieve(string $vector_store_id, string $batch_id): array
    {
        $endpoint = self::ENDPOINT . "/{$vector_store_id}/file_batches/{$batch_id}";

        $response = $this->client->request('get', $endpoint);

        return $response->json();
    }

    /**
     * Cancel a vector store file batch. This attempts to cancel the processing of files in this batch as soon as possible.
     *
     * @param  string  $vector_store_id  The ID of the vector store that the file batch belongs to.
     * @param  string  $batch_id  The ID of the file batch to cancel.
     * @return array The modified vector store file batch object.
     *
     * @see https://platform.openai.com/docs/api-reference/vector-stores-file-batches/batch-object The vector store files batch object.
     * @link https://platform.openai.com/docs/api-reference/vector-stores-file-batches/cancelBatch
     */
    public function cancel(string $vector_store_id, string $batch_id): array
    {
        $endpoint = self::ENDPOINT . "/{$vector_store_id}/file_batches/{$batch_id}/cancel";

        $response = $this->client->request('post', $endpoint);

        return $response->json();
    }

    /**
     * Returns a list of vector store files in a batch.
     *
     * @param  string  $vector_store_id  The ID of the vector store that the files belong to.
     * @param  string  $batch_id  The ID of the file batch that the files belong to.
     * @param  array  $options  Additional options to pass to the API.
     * @return array A list of vector store file objects.
     *
     * @see https://platform.openai.com/docs/api-reference/vector-stores-file-batches/batch-object The vector store files batch object.
     * @link https://platform.openai.com/docs/api-reference/vector-stores-file-batches/listBatchFiles
     */
    public function list(string $vector_store_id, string $batch_id, array $options = []): array
    {
        $endpoint = self::ENDPOINT . "/{$vector_store_id}/file_batches/{$batch_id}/files";

        $response = $this->client->request('get', $endpoint, $options);

        return $response->json();
    }
}
