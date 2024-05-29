<?php

declare(strict_types=1);

namespace Iteks\OpenAi\Api\Endpoints;

use Iteks\OpenAi\Contracts\Api\Endpoints\FineTuningInterface;
use Iteks\OpenAi\Contracts\Http\ApiClientInterface;

/**
 * Manage fine-tuning jobs to tailor a model to your specific training data.
 *
 * @link https://platform.openai.com/docs/api-reference/fine-tuning
 */
class FineTuning implements FineTuningInterface
{
    private const ENDPOINT = 'fine_tuning/jobs';

    public function __construct(
        private readonly ApiClientInterface $client,
    ) {
    }

    /**
     * Creates a fine-tuning job which begins the process of creating a new model from a given dataset.
     * Response includes details of the enqueued job including job status and the name of the fine-tuned models once complete.
     *
     * @param  string  $model  The name of the model to fine-tune.
     *                         You can select one of the supported models https://platform.openai.com/docs/guides/fine-tuning/what-models-can-be-fine-tuned.
     * @param  string  $training_file  The ID of an uploaded file that contains training data.
     *                                 See upload file for how to upload a file.
     *                                 Your dataset must be formatted as a JSONL file. Additionally, you must upload your file with the purpose fine-tune.
     *                                 See the fine-tuning guide for more details.
     * @param  array  $options  Additional options to pass to the API.
     * @return array A fine-tuning.job object.
     *
     * @see https://platform.openai.com/docs/api-reference/fine-tuning/object The fine-tuning job object.
     * @link https://platform.openai.com/docs/api-reference/fine-tuning/create
     */
    public function create(string $model, string $training_file, array $options = []): array
    {
        $options = array_merge([
            'model' => $model,
            'training_file' => $training_file,
        ], $options);

        $response = $this->client->request('post', self::ENDPOINT, $options);

        return $response->json();
    }

    /**
     * List your organization's fine-tuning jobs.
     *
     * @param  array  $options  Additional options to pass to the API.
     * @return array A list of paginated fine-tuning job objects.
     *
     * @see https://platform.openai.com/docs/api-reference/fine-tuning/object The fine-tuning job object.
     * @link https://platform.openai.com/docs/api-reference/fine-tuning/list
     */
    public function list(array $options = []): array
    {
        $response = $this->client->request('get', self::ENDPOINT, $options);

        return $response->json();
    }

    /**
     * Get status updates for a fine-tuning job.
     *
     * @param  string  $fine_tuning_job_id  The ID of the fine-tuning job to get events for.
     * @param  array  $options  Additional options to pass to the API.
     * @return array A list of fine-tuning event objects.
     *
     * @see https://platform.openai.com/docs/api-reference/fine-tuning/event-object The fine-tuning event object.
     * @link https://platform.openai.com/docs/api-reference/fine-tuning/list-events
     */
    public function listEvents(string $fine_tuning_job_id, array $options = []): array
    {
        $endpoint = self::ENDPOINT . "/{$fine_tuning_job_id}/events";

        $response = $this->client->request('get', $endpoint, $options);

        return $response->json();
    }

    /**
     * List checkpoints for a fine-tuning job.
     *
     * @param  string  $fine_tuning_job_id  The ID of the fine-tuning job to get checkpoints for.
     * @param  array  $options  Additional options to pass to the API.
     * @return array A list of fine-tuning checkpoint objects.
     *
     * @see https://platform.openai.com/docs/api-reference/fine-tuning/checkpoint-object The fine-tuning checkpoint object.
     * @link https://platform.openai.com/docs/api-reference/fine-tuning/list-checkpoints
     */
    public function listCheckpoints(string $fine_tuning_job_id, array $options = []): array
    {
        $endpoint = self::ENDPOINT . "/{$fine_tuning_job_id}/checkpoints";

        $response = $this->client->request('get', $endpoint, $options);

        return $response->json();
    }

    /**
     * Get info about a fine-tuning job.
     *
     * @param  string  $fine_tuning_job_id  The ID of the fine-tuning job.
     * @param  array  $options  Additional options to pass to the API.
     * @return array The fine-tuning object with the given ID.
     *
     * @see https://platform.openai.com/docs/api-reference/fine-tuning/object The fine-tuning job object.
     * @link https://platform.openai.com/docs/api-reference/fine-tuning/retrieve
     */
    public function retrieve(string $fine_tuning_job_id, array $options = []): array
    {
        $endpoint = self::ENDPOINT . "/{$fine_tuning_job_id}";

        $response = $this->client->request('get', $endpoint, $options);

        return $response->json();
    }

    /**
     * Immediately cancel a fine-tuning job.
     *
     * @param  string  $fine_tuning_job_id  The ID of the fine-tuning job to cancel.
     * @param  array  $options  Additional options to pass to the API.
     * @return array The cancelled fine-tuning object.
     *
     * @see https://platform.openai.com/docs/api-reference/fine-tuning/object The fine-tuning job object.
     * @link https://platform.openai.com/docs/api-reference/fine-tuning/cancel
     */
    public function cancel(string $fine_tuning_job_id, array $options = []): array
    {
        $endpoint = self::ENDPOINT . "/{$fine_tuning_job_id}/cancel";

        $response = $this->client->request('post', $endpoint, $options);

        return $response->json();
    }
}
