<?php

declare(strict_types=1);

namespace Iteks\OpenAi\Api\Legacy;

use Iteks\OpenAi\Contracts\Api\Legacy\CompletionsInterface;
use Iteks\OpenAi\Contracts\Http\ApiClientInterface;
use Iteks\OpenAi\Helpers\StreamHelper;

/**
 * Given a prompt, the model will return one or more predicted completions along with the probabilities of alternative tokens at each position. Most developer should use our Chat Completions API to leverage our best and newest models.
 *
 * @link https://platform.openai.com/docs/api-reference/completions
 */
class Completions implements CompletionsInterface
{
    private const ENDPOINT = 'completions';

    public function __construct(
        private readonly ApiClientInterface $client,
    ) {
    }

    /**
     * Creates a completion for the provided prompt and parameters.
     *
     * @param  string  $model  ID of the model to use. You can use the List models API to see all of your available models, or see our Model overview for descriptions of them.
     * @param  string  $prompt  The prompt(s) to generate completions for, encoded as a string, array of strings, array of tokens, or array of token arrays.
     *                          Note that <|endoftext|> is the document separator that the model sees during training, so if a prompt is not specified the model will generate as if from the beginning of a new document.
     * @param  array  $options  Additional options to pass to the API.
     * @return array Returns a completion object, or a sequence of completion objects if the request is streamed.
     *
     * @see https://platform.openai.com/docs/api-reference/completions/object The completion object.
     * @link https://platform.openai.com/docs/api-reference/completions/create
     */
    public function create(string $model, string $prompt, array $options = []): array
    {
        $options = array_merge([
            'model' => $model,
            'prompt' => $prompt,
        ], $options);

        $response = $this->client->request('post', self::ENDPOINT, $options);

        // If the response is not streamed, return the JSON response as an array.
        if (! $response->toPsrResponse()->getBody()->isSeekable()) {
            return $response->json();
        }

        return StreamHelper::processStream($response);
    }
}
