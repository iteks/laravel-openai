<?php

declare(strict_types=1);

namespace Iteks\OpenAi\Api\Assistants;

use Iteks\OpenAi\Contracts\Api\Assistants\MessagesInterface;
use Iteks\OpenAi\Contracts\Http\ApiClientInterface;

/**
 * Create messages within threads.
 *
 * @link https://platform.openai.com/docs/api-reference/messages
 */
class Messages implements MessagesInterface
{
    private const ENDPOINT = 'threads';

    public function __construct(
        private readonly ApiClientInterface $client,
    ) {}

    /**
     * Create a message.
     *
     * @param  string  $thread_id  The ID of the thread to create a message for.
     * @param  string  $role  The role of the entity that is creating the message. Allowed values include:
     *                        - `user`: Indicates the message is sent by an actual user and should be used in most cases to represent user-generated messages.
     *                        - `assistant`: Indicates the message is generated by the assistant. Use this value to insert messages from the assistant into the conversation.
     * @param  string|array  $content  Text content (string) The text contents of the message.
     *                                 Array of content parts (array) An array of content parts with a defined type, each can be of type `text` or images can be passed with `image_url` or `image_file`. Image types are only supported on
     * @param  array  $options  Additional options to pass to the API.
     * @return array The message object.
     *
     * @see https://platform.openai.com/docs/api-reference/messages/object The message object.
     * @link https://platform.openai.com/docs/api-reference/messages/createMessage
     */
    public function create(string $thread_id, string $role, array|string $content, array $options = []): array
    {
        $endpoint = self::ENDPOINT . "/{$thread_id}/messages";

        $options = array_merge([
            'role' => $role,
            'content' => $content,
        ], $options);

        $response = $this->client->request('post', $endpoint, $options);

        return $response->json();
    }

    /**
     * Returns a list of messages for a given thread.
     *
     * @param  string  $thread_id  The ID of the thread the messages belong to.
     * @param  array  $options  Additional options to pass to the API.
     * @return array A list of message objects.
     *
     * @see https://platform.openai.com/docs/api-reference/messages/object The message object.
     * @link https://platform.openai.com/docs/api-reference/messages/listMessages
     */
    public function list(string $thread_id, array $options = []): array
    {
        $endpoint = self::ENDPOINT . "/{$thread_id}/messages";

        $response = $this->client->request('get', $endpoint, $options);

        return $response->json();
    }

    /**
     * Retrieve a message.
     *
     * @param  string  $thread_id  The ID of the thread to which this message belongs.
     * @param  string  $message_id  The ID of the message to retrieve.
     * @return array The message object matching the specified ID.
     *
     * @see https://platform.openai.com/docs/api-reference/messages/object The message object.
     * @link https://platform.openai.com/docs/api-reference/messages/getMessage
     */
    public function retrieve(string $thread_id, string $message_id): array
    {
        $endpoint = self::ENDPOINT . "/{$thread_id}/messages/{$message_id}";

        $response = $this->client->request('get', $endpoint);

        return $response->json();
    }

    /**
     * Modifies a message.
     *
     * @param  string  $thread_id  The ID of the thread to which this message belongs.
     * @param  string  $message_id  The ID of the message to modify.
     * @param  array  $options  Additional options to pass to the API.
     * @return array The modified message object.
     *
     * @see https://platform.openai.com/docs/api-reference/messages/object The message object.
     * @link https://platform.openai.com/docs/api-reference/messages/modifyMessage
     */
    public function modify(string $thread_id, string $message_id, array $options = []): array
    {
        $endpoint = self::ENDPOINT . "/{$thread_id}/messages/{$message_id}";

        $response = $this->client->request('post', $endpoint, $options);

        return $response->json();
    }

    /**
     * Deletes a message.
     *
     * @param  string  $thread_id  The ID of the thread to which this message belongs.
     * @param  string  $message_id  The ID of the message to delete.
     * @return array Deletion status.
     *
     * @link https://platform.openai.com/docs/api-reference/messages/deleteMessage
     */
    public function delete(string $thread_id, string $message_id): array
    {
        $endpoint = self::ENDPOINT . "/{$thread_id}/messages/{$message_id}";

        $response = $this->client->request('delete', $endpoint);

        return $response->json();
    }
}
