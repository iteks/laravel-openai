<?php

declare(strict_types=1);

namespace Iteks\OpenAi\Api\Assistants;

use Iteks\OpenAi\Contracts\Api\Assistants\RunsInterface;
use Iteks\OpenAi\Contracts\Http\ApiClientInterface;
use Iteks\OpenAi\Helpers\StreamHelper;

/**
 * Represents an execution run on a thread.
 *
 * @link https://platform.openai.com/docs/api-reference/runs
 */
class Runs implements RunsInterface
{
    private const ENDPOINT = 'threads';

    public function __construct(
        private readonly ApiClientInterface $client,
    ) {}

    /**
     * Create a run.
     *
     * @param  string  $thread_id  The ID of the thread to run.
     * @param  string  $assistant_id  The ID of the assistant to use to execute this run.
     * @param  array  $options  Additional options to pass to the API.
     * @return array A run object.
     *
     * @see https://platform.openai.com/docs/api-reference/runs/object The run object.
     * @link https://platform.openai.com/docs/api-reference/runs/createRun
     */
    public function create(string $thread_id, string $assistant_id, array $options = []): array
    {
        $endpoint = self::ENDPOINT . "/{$thread_id}/runs";

        $options = array_merge([
            'assistant_id' => $assistant_id,
        ], $options);

        $response = $this->client->request('post', $endpoint, $options);

        // If the response is not streamed, return the JSON response as an array.
        if ($response->getHeaderLine('Content-Type') === 'application/json') {
            return $response->json();
        }

        // Content-Type: text/event-stream; charset=utf-8
        return StreamHelper::processStream($response);
    }

    /**
     * Create a thread and run it in one request.
     *
     * @param  string  $assistant_id  The ID of the assistant to use to execute this run.
     * @param  array  $options  Additional options to pass to the API.
     * @return array A run object.
     *
     * @see https://platform.openai.com/docs/api-reference/runs/object The run object.
     * @link https://platform.openai.com/docs/api-reference/runs/createThreadAndRun
     */
    public function createThreadAndRun(string $assistant_id, array $options = []): array
    {
        $endpoint = self::ENDPOINT . '/runs';

        $options = array_merge([
            'assistant_id' => $assistant_id,
        ], $options);

        $response = $this->client->request('post', $endpoint, $options);

        // If the response is not streamed, return the JSON response as an array.
        if ($response->getHeaderLine('Content-Type') === 'application/json') {
            return $response->json();
        }

        // Content-Type: text/event-stream; charset=utf-8
        return StreamHelper::processStream($response);
    }

    /**
     * Returns a list of runs belonging to a thread.
     *
     * @param  string  $thread_id  The ID of the thread the run belongs to.
     * @param  array  $options  Additional options to pass to the API.
     * @return array A list of run objects.
     *
     * @see https://platform.openai.com/docs/api-reference/runs/object The run object.
     * @link https://platform.openai.com/docs/api-reference/runs/listRuns
     */
    public function list(string $thread_id, array $options = []): array
    {
        $endpoint = self::ENDPOINT . "/{$thread_id}/runs";

        $response = $this->client->request('get', $endpoint, $options);

        return $response->json();
    }

    /**
     * Retrieves a run.
     *
     * @param  string  $thread_id  The ID of the thread that was run.
     * @param  string  $run_id  The ID of the run to retrieve.
     * @return array The run object matching the specified ID.
     *
     * @see https://platform.openai.com/docs/api-reference/runs/object The run object.
     * @link https://platform.openai.com/docs/api-reference/runs/getRun
     */
    public function retrieve(string $thread_id, string $run_id): array
    {
        $endpoint = self::ENDPOINT . "/{$thread_id}/runs/{$run_id}";

        $response = $this->client->request('get', $endpoint);

        return $response->json();
    }

    /**
     * Modifies a run.
     *
     * @param  string  $thread_id  The ID of the thread that was run.
     * @param  string  $run_id  The ID of the run to modify.
     * @param  array  $options  Additional options to pass to the API.
     * @return array The modified run object matching the specified ID.
     *
     * @see https://platform.openai.com/docs/api-reference/runs/object The run object.
     * @link https://platform.openai.com/docs/api-reference/runs/modifyRun
     */
    public function modify(string $thread_id, string $run_id, array $options = []): array
    {
        $endpoint = self::ENDPOINT . "/{$thread_id}/runs/{$run_id}";

        $response = $this->client->request('post', $endpoint, $options);

        return $response->json();
    }

    /**
     * When a run has the `status: "requires_action"` and `required_action.type` is `submit_tool_outputs`,
     * this endpoint can be used to submit the outputs from the tool calls once they're all completed.
     * All outputs must be submitted in a single request.
     *
     * @param  string  $thread_id  The ID of the thread to which this run belongs.
     * @param  string  $run_id  The ID of the run that requires the tool output submission.
     * @param  array  $tool_outputs  A list of tools for which the outputs are being submitted.
     * @param  array  $options  Additional options to pass to the API.
     * @return array The modified run object matching the specified ID.
     *
     * @see https://platform.openai.com/docs/api-reference/runs/object The run object.
     * @link https://platform.openai.com/docs/api-reference/runs/submitToolOutputs
     */
    public function submitToolOutputs(string $thread_id, string $run_id, array $tool_outputs, array $options = []): array
    {
        $endpoint = self::ENDPOINT . "/{$thread_id}/runs/{$run_id}/submit_tool_outputs";

        $options = array_merge([
            'tool_outputs' => $tool_outputs,
        ], $options);

        $response = $this->client->request('post', $endpoint, $options);

        // If the response is not streamed, return the JSON response as an array.
        if ($response->getHeaderLine('Content-Type') === 'application/json') {
            return $response->json();
        }

        // Content-Type: text/event-stream; charset=utf-8
        return StreamHelper::processStream($response);
    }

    /**
     * Cancels a run that is `in_progress`.
     *
     * @param  string  $thread_id  The ID of the thread to which this run belongs.
     * @param  string  $run_id  The ID of the run to cancel.
     * @return array The modified run object matching the specified ID.
     *
     * @see https://platform.openai.com/docs/api-reference/runs/object The run object.
     * @link https://platform.openai.com/docs/api-reference/runs/cancelRun
     */
    public function cancel(string $thread_id, string $run_id): array
    {
        $endpoint = self::ENDPOINT . "/{$thread_id}/runs/{$run_id}/cancel";

        $response = $this->client->request('post', $endpoint);

        return $response->json();
    }
}
