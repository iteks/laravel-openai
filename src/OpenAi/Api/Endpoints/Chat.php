<?php

declare(strict_types=1);

namespace Iteks\OpenAi\Api\Endpoints;

use Iteks\OpenAi\Contracts\Api\Endpoints\ChatInterface;
use Iteks\OpenAi\Contracts\Http\ApiClientInterface;
use Iteks\OpenAi\Helpers\StreamHelper;

/**
 * Given a list of messages comprising a conversation, the model will return a response.
 *
 * @link https://platform.openai.com/docs/api-reference/chat
 */
class Chat implements ChatInterface
{
    private const ENDPOINT = 'chat';

    public function __construct(
        private readonly ApiClientInterface $client,
    ) {
    }

    /**
     * Creates a model response for the given chat conversation.
     *
     * @param  array  $messages  A list of messages comprising the conversation so far.
     * @param  string  $model  ID of the model to use. See the model endpoint compatibility table for details on which models work with the Chat API.
     * @param  array  $options  Additional options to pass to the API.
     * @return array Returns a chat completion object, or a streamed sequence of chat completion chunk objects if the request is streamed.
     *
     * @see https://platform.openai.com/docs/api-reference/chat/object The chat completion object.
     * @see https://platform.openai.com/docs/api-reference/chat/streaming The chat completion chunk object.
     * @link https://platform.openai.com/docs/api-reference/chat/create
     */
    public function create(array $messages, string $model, array $options = []): array
    {
        $endpoint = self::ENDPOINT . '/completions';

        $options = array_merge([
            'messages' => $messages,
            'model' => $model,
        ], $options);

        $response = $this->client->request('post', $endpoint, $options);

        // If the response is not streamed, return the JSON response as an array.
        if (! $response->toPsrResponse()->getBody()->isSeekable()) {
            return $response->json();
        }

        return StreamHelper::processStream($response);
    }
}
