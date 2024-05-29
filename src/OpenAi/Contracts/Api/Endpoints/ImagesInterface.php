<?php

declare(strict_types=1);

namespace Iteks\OpenAi\Contracts\Api\Endpoints;

interface ImagesInterface
{
    public function create(string $prompt, array $options = []): array;

    public function createEdit(mixed $image, string $prompt, array $options = []): array;

    public function createVariation(mixed $image, array $options = []): array;
}
