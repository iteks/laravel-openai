<?php

declare(strict_types=1);

namespace Iteks\OpenAi\Api\Endpoints;

use Iteks\OpenAi\Contracts\Api\Endpoints\ImagesInterface;
use Iteks\OpenAi\Contracts\Http\ApiClientInterface;

/**
 * Given a prompt and/or an input image, the model will generate a new image.
 *
 * @link https://platform.openai.com/docs/api-reference/images
 */
class Images implements ImagesInterface
{
    private const ENDPOINT = 'images';

    public function __construct(
        private readonly ApiClientInterface $client,
    ) {}

    /**
     * Creates an image given a prompt.
     *
     * @param  string  $prompt  A text description of the desired image(s). The maximum length is 1000 characters for `dall-e-2` and 4000 characters for `dall-e-3`.
     * @param  array  $options  Additional options to pass to the API.
     * @return array Returns a list of image objects.
     *
     * @see https://platform.openai.com/docs/api-reference/images/object The image object.
     * @link https://platform.openai.com/docs/api-reference/images/create
     */
    public function create(string $prompt, array $options = []): array
    {
        $endpoint = self::ENDPOINT . '/generations';

        $options = array_merge([
            'prompt' => $prompt,
        ], $options);

        $response = $this->client->request('post', $endpoint, $options);

        return $response->json();
    }

    /**
     * Creates an edited or extended image given an original image and a prompt.
     *
     * @param  mixed  $image  The image to edit. Must be a valid PNG file, less than 4MB, and square. If mask is not provided, image must have transparency, which will be used as the mask.
     * @param  string  $prompt  A text description of the desired image(s). The maximum length is 1000 characters.
     * @param  array  $options  Additional options to pass to the API.
     * @return array Returns a list of image objects.
     *
     * @see https://platform.openai.com/docs/api-reference/images/object The image object.
     * @link https://platform.openai.com/docs/api-reference/images/createEdit
     */
    public function createEdit(mixed $image, string $prompt, array $options = []): array
    {
        $endpoint = self::ENDPOINT . '/edits';

        // Initialize attachments with the image.
        $attachments = ['image' => $image];

        // Process the mask if provided.
        if (array_key_exists('mask', $options)) {
            $attachments['mask'] = $options['mask'];
            unset($options['mask']);
        }

        $options = array_merge([
            'prompt' => $prompt,
        ], $options);

        $response = $this->client->request('post', $endpoint, $options, $attachments);

        return $response->json();
    }

    /**
     * Creates a variation of a given image.
     *
     * @param  mixed  $image  The image to use as the basis for the variation(s). Must be a valid PNG file, less than 4MB, and square.
     * @param  array  $options  Additional options to pass to the API.
     * @return array Returns a list of image objects.
     *
     * @see https://platform.openai.com/docs/api-reference/images/object The image object.
     * @link https://platform.openai.com/docs/api-reference/images/createVariation
     */
    public function createVariation(mixed $image, array $options = []): array
    {
        $endpoint = self::ENDPOINT . '/variations';

        $response = $this->client->request('post', $endpoint, $options, ['image' => $image]);

        return $response->json();
    }
}
