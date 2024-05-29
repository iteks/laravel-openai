<?php

declare(strict_types=1);

namespace Iteks\OpenAi\Contracts\Api\Endpoints;

interface EmbeddingsInterface
{
    public function create(string $input, string $model, array $options = []): array;
}
