<?php

declare(strict_types=1);

namespace Iteks\OpenAi\Api\Endpoints;

use Iteks\OpenAi\Contracts\Api\Endpoints\ModelsInterface;
use Iteks\OpenAi\Contracts\Http\ApiClientInterface;

/**
 * List and describe the various models available in the API. You can refer to the Models documentation to understand what models are available and the differences between them.
 *
 * @link https://platform.openai.com/docs/api-reference/models
 */
class Models implements ModelsInterface
{
    private const ENDPOINT = 'models';

    public function __construct(
        private readonly ApiClientInterface $client,
    ) {
    }

    /**
     * Lists the currently available models, and provides basic information about each one such as the owner and availability.
     *
     * @return array A list of model objects.
     *
     * @see https://platform.openai.com/docs/api-reference/models/object The model object.
     * @link https://platform.openai.com/docs/api-reference/models/list
     */
    public function list(): array
    {
        $response = $this->client->request('get', self::ENDPOINT);

        return $response->json();
    }

    /**
     * Retrieves a model instance, providing basic information about the model such as the owner and permissioning.
     *
     * @param  string  $model_id  The ID of the model to use for this request.
     * @return array The model object matching the specified ID.
     *
     * @see https://platform.openai.com/docs/api-reference/models/object The model object.
     * @link https://platform.openai.com/docs/api-reference/models/retrieve
     */
    public function retrieve(string $model_id): array
    {
        $endpoint = self::ENDPOINT . "/{$model_id}";

        $response = $this->client->request('get', $endpoint);

        return $response->json();
    }

    /**
     * Delete a fine-tuned model. You must have the Owner role in your organization to delete a model.
     *
     * @param  string  $model  The model to delete.
     * @return array Deletion status.
     *
     * @link https://platform.openai.com/docs/api-reference/models/delete
     */
    public function delete(string $model): array
    {
        $endpoint = self::ENDPOINT . "/{$model}";

        $response = $this->client->request('delete', $endpoint);

        return $response->json();
    }
}
