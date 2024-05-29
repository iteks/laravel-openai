<?php

declare(strict_types=1);

namespace Iteks\OpenAi\Contracts\Api\Endpoints;

interface ChatInterface
{
    public function create(array $messages, string $model, array $options = []): array;
}
