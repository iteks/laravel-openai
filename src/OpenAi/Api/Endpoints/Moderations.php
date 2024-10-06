<?php

declare(strict_types=1);

namespace Iteks\OpenAi\Api\Endpoints;

use Iteks\OpenAi\Contracts\Api\Endpoints\ModerationsInterface;
use Iteks\OpenAi\Contracts\Http\ApiClientInterface;

/**
 * Given some input text, outputs if the model classifies it as potentially harmful across several categories.
 *
 * @link https://platform.openai.com/docs/api-reference/moderations
 */
class Moderations implements ModerationsInterface
{
    private const ENDPOINT = 'moderations';

    public function __construct(
        private readonly ApiClientInterface $client,
    ) {}

    /**
     * Classifies if text is potentially harmful.
     *
     * @param  string  $input  The input text to classify.
     * @param  array  $options  Additional options to pass to the API.
     * @return array A moderation object.
     *
     * @see https://platform.openai.com/docs/api-reference/moderations/object The moderation object.
     * @link https://platform.openai.com/docs/api-reference/moderations/create
     */
    public function create(string $input, array $options = []): array
    {
        $options = array_merge([
            'input' => $input,
        ], $options);

        $response = $this->client->request('post', self::ENDPOINT, $options);

        return $response->json();
    }
}
