<?php

declare(strict_types=1);

namespace Iteks\OpenAi\Api\Endpoints;

use Iteks\OpenAi\Contracts\Api\Endpoints\BatchInterface;
use Iteks\OpenAi\Contracts\Http\ApiClientInterface;

/**
 * Create large batches of API requests for asynchronous processing. The Batch API returns completions within 24 hours for a 50% discount.
 *
 * @link https://platform.openai.com/docs/api-reference/batch
 */
class Batch implements BatchInterface
{
    private const ENDPOINT = 'batch/jobs';

    public function __construct(
        private readonly ApiClientInterface $client,
    ) {
    }

    /**
     * Creates and executes a batch from an uploaded file of requests.
     *
     * @param  string  $input_file_id  The ID of an uploaded file that contains requests for the new batch.
     *                                 See upload file for how to upload a file https://platform.openai.com/docs/api-reference/files/create.
     *                                 Your input file must be formatted as a JSONL file, and must be uploaded with the purpose batch. The file can contain up to 50,000 requests, and can be up to 100 MB in size.
     * @param  string  $endpoint  The endpoint to be used for all requests in the batch. Currently `/v1/chat/completions`, `/v1/embeddings`, and `/v1/completions` are supported. Note that `/v1/embeddings` batches are also restricted to a maximum of 50,000 embedding inputs across all requests in the batch.
     * @param  string  $completion_window  The time frame within which the batch should be processed. Currently only `24h` is supported.
     * @param  array  $options  Additional options to pass to the API.
     * @return array The created Batch object.
     *
     * @see https://platform.openai.com/docs/api-reference/batch/object The batch job object.
     * @link https://platform.openai.com/docs/api-reference/batch/create
     */
    public function create(string $input_file_id, string $endpoint, string $completion_window, array $options = []): array
    {
        $options = array_merge([
            'input_file_id' => $input_file_id,
            'endpoint' => $endpoint,
            'completion_window' => $completion_window,
        ], $options);

        $response = $this->client->request('post', self::ENDPOINT, $options);

        return $response->json();
    }

    /**
     * Retrieves a batch.
     *
     * @param  string  $batch_job_id  The ID of the batch to retrieve.
     * @return array The Batch object matching the specified ID.
     *
     * @see https://platform.openai.com/docs/api-reference/batch/object The batch job object.
     * @link https://platform.openai.com/docs/api-reference/batch/retrieve
     */
    public function retrieve(string $batch_job_id): array
    {
        $endpoint = self::ENDPOINT . "/{$batch_job_id}";

        $response = $this->client->request('get', $endpoint);

        return $response->json();
    }

    /**
     * Cancels an in-progress batch.
     *
     * @param  string  $batch_job_id  The ID of the batch to cancel.
     * @return array The Batch object matching the specified ID.
     *
     * @see https://platform.openai.com/docs/api-reference/batch/object The batch job object.
     * @link https://platform.openai.com/docs/api-reference/batch/cancel
     */
    public function cancel(string $batch_job_id): array
    {
        $endpoint = self::ENDPOINT . "/{$batch_job_id}/cancel";

        $response = $this->client->request('post', $endpoint);

        return $response->json();
    }

    /**
     * List your organization's batches.
     *
     * @param  array  $options  Additional options to pass to the API.
     * @return array A list of paginated Batch objects.
     *
     * @see https://platform.openai.com/docs/api-reference/batch/object The batch job object.
     * @link https://platform.openai.com/docs/api-reference/batch/list
     */
    public function list(array $options = []): array
    {
        $response = $this->client->request('get', self::ENDPOINT, $options);

        return $response->json();
    }
}
