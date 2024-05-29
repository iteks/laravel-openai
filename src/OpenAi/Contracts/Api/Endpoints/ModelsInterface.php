<?php

declare(strict_types=1);

namespace Iteks\OpenAi\Contracts\Api\Endpoints;

interface ModelsInterface
{
    public function list(): array;

    public function retrieve(string $model_id): array;

    public function delete(string $model): array;
}
