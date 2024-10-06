<?php

declare(strict_types=1);

namespace Iteks\OpenAi\Api\Assistants;

use Iteks\OpenAi\Contracts\Api\Assistants\AssistantsInterface;
use Iteks\OpenAi\Contracts\Http\ApiClientInterface;

/**
 * Build assistants that can call models and use tools to perform tasks.
 *
 * @link https://platform.openai.com/docs/api-reference/assistants
 */
class Assistants implements AssistantsInterface
{
    private const ENDPOINT = 'assistants';

    public function __construct(
        private readonly ApiClientInterface $client,
    ) {}

    /**
     * Create an assistant with a model and instructions.
     *
     * @param  string  $model  ID of the model to use. You can use the List models API to see all of your available models, or see our Model overview for descriptions of them.
     * @param  array  $options  Additional options to pass to the API.
     * @return array An assistant object.
     *
     * @see https://platform.openai.com/docs/api-reference/assistants/object The assistant object.
     * @link https://platform.openai.com/docs/api-reference/assistants/createAssistant
     */
    public function create(string $model, array $options = []): array
    {
        $options = array_merge([
            'model' => $model,
        ], $options);

        $response = $this->client->request('post', self::ENDPOINT, $options);

        return $response->json();
    }

    /**
     * Returns a list of assistants.
     *
     * @param  array  $options  Additional options to pass to the API.
     * @return array A list of assistant objects.
     *
     * @see https://platform.openai.com/docs/api-reference/assistants/object The assistant object.
     * @link https://platform.openai.com/docs/api-reference/assistants/listAssistants
     */
    public function list(array $options = []): array
    {
        $response = $this->client->request('get', self::ENDPOINT, $options);

        return $response->json();
    }

    /**
     * Retrieves an assistant.
     *
     * @param  string  $assistant_id  The ID of the assistant to retrieve.
     * @return array The assistant object matching the specified ID.
     *
     * @see https://platform.openai.com/docs/api-reference/assistants/object The assistant object.
     * @link https://platform.openai.com/docs/api-reference/assistants/getAssistant
     */
    public function retrieve(string $assistant_id): array
    {
        $endpoint = self::ENDPOINT . "/{$assistant_id}";

        $response = $this->client->request('get', $endpoint);

        return $response->json();
    }

    /**
     * Modifies an assistant.
     *
     * @param  string  $assistant_id  The ID of the assistant to modify.
     * @param  array  $options  Additional options to pass to the API.
     * @return array The modified assistant object.
     *
     * @see https://platform.openai.com/docs/api-reference/assistants/object The assistant object.
     * @link https://platform.openai.com/docs/api-reference/assistants/modifyAssistant
     */
    public function modify(string $assistant_id, array $options = []): array
    {
        $endpoint = self::ENDPOINT . "/{$assistant_id}";

        $response = $this->client->request('post', $endpoint, $options);

        return $response->json();
    }

    /**
     * Delete an assistant.
     *
     * @param  string  $assistant_id  The ID of the assistant to delete.
     * @return array Deletion status.
     *
     * @link https://platform.openai.com/docs/api-reference/assistants/deleteAssistant
     */
    public function delete(string $assistant_id): array
    {
        $endpoint = self::ENDPOINT . "/{$assistant_id}";

        $response = $this->client->request('delete', $endpoint);

        return $response->json();
    }
}
