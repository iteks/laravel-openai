<?php

declare(strict_types=1);

namespace Iteks\OpenAi\Contracts\Api\Endpoints;

interface ModerationsInterface
{
    public function create(string $input, array $options = []): array;
}
