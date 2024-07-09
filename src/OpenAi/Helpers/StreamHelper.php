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
        // Log::info('Raw data response:', ['response' => $response->body()]); // Debugging

        // Split the response by lines to handle each event and data pair as chunks
        $lines = explode("\n", $response->body());
        $chunks = [];
        $currentChunk = [];

        foreach ($lines as $line) {
            $line = trim($line);

            if ($line === '') {
                // Empty line indicates the end of a streamed chunk
                if (! empty($currentChunk)) {
                    $chunks[] = $currentChunk;
                    $currentChunk = [];
                }

                continue;
            }

            if (strpos($line, 'event:') === 0) {
                $currentChunk['event'] = trim(substr($line, 6));
            } elseif (strpos($line, 'data:') === 0) {
                if (! isset($currentChunk['data'])) {
                    $currentChunk['data'] = '';
                }

                $currentChunk['data'] .= substr($line, 5);
            }
        }

        // Add the last chunk if it exists
        if (! empty($currentChunk)) {
            $chunks[] = $currentChunk;
        }

        // Decode each chunk's data part
        foreach ($chunks as &$chunk) {
            if (isset($chunk['data'])) {
                $chunk['data'] = self::decodeChunk($chunk['data']);
            }
        }

        return $chunks;
    }

    private static function decodeChunk(string $chunk): array
    {
        $chunk = trim($chunk);

        if ($chunk === '[DONE]') {
            return [];
        }

        $decoded = json_decode($chunk, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            $errorMessage = 'JSON decoding error: ' . json_last_error_msg();

            Log::error($errorMessage, ['chunk' => $chunk]);

            throw new RuntimeException($errorMessage);
        }

        // Log::info('Decoded chunk', ['decoded' => $decoded]); // Debugging

        return $decoded;
    }
}
