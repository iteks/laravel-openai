<?php

declare(strict_types=1);

namespace Iteks\OpenAi\Api\Assistants;

use Iteks\OpenAi\Contracts\Api\Assistants\RunStepsInterface;
use Iteks\OpenAi\Contracts\Http\ApiClientInterface;

/**
 * Represents the steps (model and tool calls) taken during the run.
 *
 * @link https://platform.openai.com/docs/api-reference/run-steps
 */
class RunSteps implements RunStepsInterface
{
    private const ENDPOINT = 'threads';

    public function __construct(
        private readonly ApiClientInterface $client,
    ) {}

    /**
     * Returns a list of run steps belonging to a run.
     *
     * @param  string  $thread_id  The ID of the thread the run and run steps belong to.
     * @param  string  $run_id  The ID of the run the run steps belong to.
     * @param  array  $options  Additional options to pass to the API.
     * @return array A list of run step objects.
     *
     * @see https://platform.openai.com/docs/api-reference/run-steps/step-object The run step object.
     * @link https://platform.openai.com/docs/api-reference/run-steps/listRunSteps
     */
    public function list(string $thread_id, string $run_id, array $options = []): array
    {
        $endpoint = self::ENDPOINT . "/{$thread_id}/runs/{$run_id}/steps";

        $response = $this->client->request('get', $endpoint, $options);

        return $response->json();
    }

    /**
     * Retrieves a run step.
     *
     * @param  string  $thread_id  The ID of the thread to which the run and run step belongs.
     * @param  string  $run_id  The ID of the run to which the run step belongs.
     * @param  string  $step_id  The ID of the run step to retrieve.
     * @return array The run step object matching the specified ID.
     *
     * @see https://platform.openai.com/docs/api-reference/run-steps/step-object The run step object.
     * @link https://platform.openai.com/docs/api-reference/run-steps/getRunStep
     */
    public function retrieve(string $thread_id, string $run_id, string $step_id): array
    {
        $endpoint = self::ENDPOINT . "/{$thread_id}/runs/{$run_id}/steps/{$step_id}";

        $response = $this->client->request('get', $endpoint);

        return $response->json();
    }
}
