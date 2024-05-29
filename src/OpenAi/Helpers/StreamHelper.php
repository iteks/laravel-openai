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

        foreach ($rawChunks as $rawChunk) {
            $chunk = trim($rawChunk);

            if ($chunk === '[DONE]') {
                break;
            }

            if (! empty($chunk)) {
                $decodedChunk = json_decode($chunk, true);

                if (json_last_error() !== JSON_ERROR_NONE) {
                    $errorMessage = 'JSON decoding error: ' . json_last_error_msg();

                    Log::error($errorMessage);

                    throw new RuntimeException($errorMessage);
                }

                $chunks[] = $decodedChunk;
            }
        }

        return $chunks;
    }
}
