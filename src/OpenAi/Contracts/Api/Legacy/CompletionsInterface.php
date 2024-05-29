<?php

declare(strict_types=1);

namespace Iteks\OpenAi\Contracts\Api\Legacy;

interface CompletionsInterface
{
    public function create(string $model, string $prompt, array $options = []): array;
}
