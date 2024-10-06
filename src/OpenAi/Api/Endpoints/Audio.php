<?php

declare(strict_types=1);

namespace Iteks\OpenAi\Api\Endpoints;

use Illuminate\Http\Client\Response;
use Iteks\OpenAi\Contracts\Api\Endpoints\AudioInterface;
use Iteks\OpenAi\Contracts\Http\ApiClientInterface;

/**
 * Learn how to turn audio into text or text into audio.
 *
 * @link https://platform.openai.com/docs/api-reference/audio
 */
class Audio implements AudioInterface
{
    private const ENDPOINT = 'audio';

    public function __construct(
        private readonly ApiClientInterface $client,
    ) {}

    /**
     * Generates audio from the input text.
     *
     * @param  string  $model  One of the available TTS models: `tts-1` or `tts-1-hd`.
     * @param  string  $input  The text to generate audio for. The maximum length is 4096 characters.
     * @param  string  $voice  The voice to use when generating the audio. Supported voices are `alloy`, `echo`, `fable`, `onyx`, `nova`, and `shimmer`. Previews of the voices are available in the Text to speech guide.
     * @param  array  $options  Additional options to pass to the API.
     * @return Response The audio file content.
     *
     * @link https://platform.openai.com/docs/api-reference/audio/createSpeech
     */
    public function createSpeech(string $model, string $input, string $voice, array $options = []): Response
    {
        $endpoint = self::ENDPOINT . '/speech';

        $options = array_merge([
            'model' => $model,
            'input' => $input,
            'voice' => $voice,
        ], $options);

        return $this->client->request('post', $endpoint, $options);
    }

    /**
     * Transcribes audio into the input language.
     *
     * @param  mixed  $file  The audio file object (not file name) to transcribe, in one of these formats: flac, mp3, mp4, mpeg, mpga, m4a, ogg, wav, or webm.
     * @param  string  $model  ID of the model to use. Only `whisper-1` (which is powered by our open source Whisper V2 model) is currently available.
     * @param  array  $options  Additional options to pass to the API.
     * @return array The transcription object or a verbose transcription object.
     *
     * @see https://platform.openai.com/docs/api-reference/audio/json-object The transcription object (JSON).
     * @see https://platform.openai.com/docs/api-reference/audio/verbose-json-object The transcription object (Verbose JSON).
     * @link https://platform.openai.com/docs/api-reference/audio/createTranscription
     */
    public function createTranscription(mixed $file, string $model, array $options = []): array
    {
        $endpoint = self::ENDPOINT . '/transcriptions';

        $options = array_merge([
            'model' => $model,
        ], $options);

        $response = $this->client->request('post', $endpoint, $options, ['file' => $file]);

        return $response->json();
    }

    /**
     * Translates audio into English.
     *
     * @param  mixed  $file  The audio file object (not file name) translate, in one of these formats: flac, mp3, mp4, mpeg, mpga, m4a, ogg, wav, or webm.
     * @param  string  $model  ID of the model to use. Only `whisper-1` (which is powered by our open source Whisper V2 model) is currently available.
     * @param  array  $options  Additional options to pass to the API.
     * @return array The translated text.
     *
     * @link https://platform.openai.com/docs/api-reference/audio/createTranslation
     */
    public function createTranslation(mixed $file, string $model, array $options = []): array
    {
        $endpoint = self::ENDPOINT . '/translations';

        $options = array_merge([
            'model' => $model,
        ], $options);

        $response = $this->client->request('post', $endpoint, $options, ['file' => $file]);

        return $response->json();
    }
}
