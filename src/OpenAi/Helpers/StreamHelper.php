<?php

declare(strict_types=1);

namespace Iteks\OpenAi\Helpers;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Log;
use RuntimeException;

class StreamHelper
{
    /**
     * Read and return stream chunks in an array.
     */
    public static function processStream(Response $response): array
    {
        // Split the response by "data: " to handle each event.
        $rawChunks = explode('data: ', $response->body());
        $chunks = [];

        // Log::info('Processing response stream:', ['rawChunks' => $rawChunks]); // Debugging

        foreach ($rawChunks as $rawChunk) {
            $chunk = trim($rawChunk);

            if ($chunk === '[DONE]') {
                break;
            }

            if (! empty($chunk)) {
                // Separate event from data
                if (strpos($chunk, 'event:') !== false) {
                    $eventData = explode("\n", $chunk);

                    foreach ($eventData as $data) {
                        $data = trim($data);

                        if (strpos($data, 'data:') === 0) {
                            $data = substr($data, 5);
                            $chunks[] = self::decodeChunk($data);
                        }
                    }
                } else {
                    $chunks[] = self::decodeChunk($chunk);
                }
            }
        }

        return $chunks;
    }

    private static function decodeChunk(string $chunk): array
    {
        $decodedChunk = json_decode($chunk, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            $errorMessage = 'JSON decoding error: ' . json_last_error_msg();

            Log::error($errorMessage, ['chunk' => $chunk]);

            throw new RuntimeException($errorMessage);
        }

        return $decodedChunk;
    }
}
