<?php

declare(strict_types=1);

namespace Iteks\OpenAi\Api\Assistants;

use Iteks\OpenAi\Contracts\Api\Assistants\ThreadsInterface;
use Iteks\OpenAi\Contracts\Http\ApiClientInterface;

/**
 * Create threads that assistants can interact with.
 *
 * @link https://platform.openai.com/docs/api-reference/threads
 */
class Threads implements ThreadsInterface
{
    private const ENDPOINT = 'threads';

    public function __construct(
        private readonly ApiClientInterface $client,
    ) {
    }

    /**
     * Create a thread.
     *
     * @param  array  $options  Additional options to pass to the API.
     * @return array A thread object.
     *
     * @see https://platform.openai.com/docs/api-reference/threads/object The thread object.
     * @link https://platform.openai.com/docs/api-reference/threads/createThread
     */
    public function create(array $options = []): array
    {
        $response = $this->client->request('post', self::ENDPOINT, $options);

        return $response->json();
    }

    /**
     * Retrieves a thread.
     *
     * @param  string  $thread_id  The ID of the thread to retrieve.
     * @return array The thread object matching the specified ID.
     *
     * @see https://platform.openai.com/docs/api-reference/threads/object The thread object.
     * @link https://platform.openai.com/docs/api-reference/threads/getThread
     */
    public function retrieve(string $thread_id): array
    {
        $endpoint = self::ENDPOINT . "/{$thread_id}";

        $response = $this->client->request('get', $endpoint);

        return $response->json();
    }

    /**
     * Modifies a thread.
     *
     * @param  string  $thread_id  The ID of the thread to modify. Only the `metadata` can be modified.
     * @param  array  $options  Additional options to pass to the API.
     * @return array The modified thread object matching the specified ID.
     *
     * @see https://platform.openai.com/docs/api-reference/threads/object The thread object.
     * @link https://platform.openai.com/docs/api-reference/threads/modifyThread
     */
    public function modify(string $thread_id, array $options = []): array
    {
        $endpoint = self::ENDPOINT . "/{$thread_id}";

        $response = $this->client->request('post', $endpoint, $options);

        return $response->json();
    }

    /**
     * Delete a thread.
     *
     * @param  string  $thread_id  The ID of the thread to delete.
     * @return array Deletion status.
     *
     * @link https://platform.openai.com/docs/api-reference/threads/deleteThread
     */
    public function delete(string $thread_id): array
    {
        $endpoint = self::ENDPOINT . "/{$thread_id}";

        $response = $this->client->request('delete', $endpoint);

        return $response->json();
    }
}
