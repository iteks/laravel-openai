<?php

declare(strict_types=1);

namespace Iteks\OpenAi\Api\Assistants;

use Iteks\OpenAi\Contracts\Api\Assistants\VectorStoreFilesInterface;
use Iteks\OpenAi\Contracts\Http\ApiClientInterface;

/**
 * Vector store files represent files inside a vector store.
 *
 * @link https://platform.openai.com/docs/api-reference/vector-stores-files
 */
class VectorStoreFiles implements VectorStoreFilesInterface
{
    private const ENDPOINT = 'vector_stores';

    public function __construct(
        private readonly ApiClientInterface $client,
    ) {}

    /**
     * Create a vector store file by attaching a File to a vector store.
     *
     * @param  string  $vector_store_id  The ID of the vector store for which to create a File.
     * @param  string  $file_id  A File ID that the vector store should use. Useful for tools like file_search that can access files.
     * @return array A vector store file object.
     *
     * @see https://platform.openai.com/docs/api-reference/vector-stores-files/file-object The vector store file object.
     * @link https://platform.openai.com/docs/api-reference/vector-stores-files/createFile
     */
    public function create(string $vector_store_id, string $file_id): array
    {
        $endpoint = self::ENDPOINT . "/{$vector_store_id}/files";

        $response = $this->client->request('post', $endpoint, ['file_id' => $file_id]);

        return $response->json();
    }

    /**
     * Returns a list of vector store files.
     *
     * @param  string  $vector_store_id  The ID of the vector store that the files belong to.
     * @param  array  $options  Additional options to pass to the API.
     * @return array A list of vector store file objects.
     *
     * @see https://platform.openai.com/docs/api-reference/vector-stores-files/file-object The vector store file object.
     * @link https://platform.openai.com/docs/api-reference/vector-stores-files/listFiles
     */
    public function list(string $vector_store_id, array $options = []): array
    {
        $endpoint = self::ENDPOINT . "/{$vector_store_id}/files";

        $response = $this->client->request('get', $endpoint, $options);

        return $response->json();
    }

    /**
     * Retrieves a vector store file.
     *
     * @param  string  $vector_store_id  The ID of the vector store that the file belongs to.
     * @param  string  $file_id  The ID of the file being retrieved.
     * @return array The vector store file object.
     *
     * @see https://platform.openai.com/docs/api-reference/vector-stores-files/file-object The vector store file object.
     * @link https://platform.openai.com/docs/api-reference/vector-stores-files/getFile
     */
    public function retrieve(string $vector_store_id, string $file_id): array
    {
        $endpoint = self::ENDPOINT . "/{$vector_store_id}/files/{$file_id}";

        $response = $this->client->request('get', $endpoint);

        return $response->json();
    }

    /**
     * Delete a vector store file. This will remove the file from the vector store but the file itself will not be deleted. To delete the file, use the delete file endpoint.
     *
     * @param  string  $vector_store_id  The ID of the vector store that the file belongs to.
     * @param  string  $file_id  The ID of the file to delete.
     * @return array Deletion status.
     *
     * @link https://platform.openai.com/docs/api-reference/vector-stores-files/deleteFile
     */
    public function delete(string $vector_store_id, string $file_id): array
    {
        $endpoint = self::ENDPOINT . "/{$vector_store_id}/files/{$file_id}";

        $response = $this->client->request('delete', $endpoint);

        return $response->json();
    }
}
