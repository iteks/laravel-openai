<?php

declare(strict_types=1);

namespace Iteks\OpenAi\Contracts\Api\Endpoints;

use Illuminate\Http\Client\Response;

interface AudioInterface
{
    public function createSpeech(string $model, string $input, string $voice, array $options = []): Response;

    public function createTranscription(mixed $file, string $model, array $options = []): array;

    public function createTranslation(mixed $file, string $model, array $options = []): array;
}
