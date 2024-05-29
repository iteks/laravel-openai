<?php

declare(strict_types=1);

namespace Iteks\OpenAi\Api\Endpoints;

use Iteks\OpenAi\Contracts\Api\Endpoints\FilesInterface;
use Iteks\OpenAi\Contracts\Http\ApiClientInterface;

/**
 * Files are used to upload documents that can be used with features like Assistants, Fine-tuning, and Batch API.
 *
 * @link https://platform.openai.com/docs/api-reference/files
 */
class Files implements FilesInterface
{
    private const ENDPOINT = 'files';

    public function __construct(
        private readonly ApiClientInterface $client,
    ) {
    }

    /**
     * Upload a file that can be used across various endpoints. Individual files can be up to 512 MB, and the size of all files uploaded by one organization can be up to 100 GB.
     * The Assistants API supports files up to 2 million tokens and of specific file types. See the Assistants Tools guide for details.
     * The Fine-tuning API only supports .jsonl files.
     * The Batch API only supports .jsonl files up to 100 MB in size.
     *
     * @param  mixed  $file  The File object (not file name) to be uploaded.
     * @param  string  $purpose  The intended purpose of the uploaded file.
     *                           Use "assistants" for Assistants and Message files, "vision" for Assistants image file inputs, "batch" for Batch API, and "fine-tune" for Fine-tuning.
     * @return array The uploaded File object.
     *
     * @see https://platform.openai.com/docs/api-reference/files/object The file object.
     * @link https://platform.openai.com/docs/api-reference/files/create
     */
    public function create(mixed $file, string $purpose): array
    {
        $response = $this->client->request('post', self::ENDPOINT, ['purpose' => $purpose], ['file' => $file]);

        return $response->json();
    }

    /**
     * Returns a list of files that belong to the user's organization.
     *
     * @param  array  $options  Additional options to pass to the API.
     * @return array A list of file objects.
     *
     * @see https://platform.openai.com/docs/api-reference/files/object The file object.
     * @link https://platform.openai.com/docs/api-reference/files/list
     */
    public function list(array $options = []): array
    {
        $response = $this->client->request('get', self::ENDPOINT, $options);

        return $response->json();
    }

    /**
     * Returns information about a specific file.
     *
     * @param  string  $file_id  The ID of the file to use for this request.
     * @return array The File object matching the specified ID.
     *
     * @see https://platform.openai.com/docs/api-reference/files/object The file object.
     * @link https://platform.openai.com/docs/api-reference/files/retrieve
     */
    public function retrieve(string $file_id): array
    {
        $endpoint = self::ENDPOINT . "/{$file_id}";

        $response = $this->client->request('get', $endpoint);

        return $response->json();
    }

    /**
     * Deletes a file.
     *
     * @param  string  $file_id  The ID of the file to use for this request.
     * @return array Deletion status.
     *
     * @link https://platform.openai.com/docs/api-reference/files/delete
     */
    public function delete(string $file_id): array
    {
        $endpoint = self::ENDPOINT . "/{$file_id}";

        $response = $this->client->request('delete', $endpoint);

        return $response->json();
    }

    /**
     * Returns the contents of the specified file.
     *
     * @param  string  $file_id  The ID of the file to use for this request.
     * @return string The file content.
     *
     * @link https://platform.openai.com/docs/api-reference/files/retrieve-contents
     */
    public function retrieveContents(string $file_id): string
    {
        $endpoint = self::ENDPOINT . "/{$file_id}/content";

        $response = $this->client->request('get', $endpoint);

        return $response->body();
    }
}
