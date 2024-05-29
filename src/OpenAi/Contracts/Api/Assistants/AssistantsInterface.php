<?php

declare(strict_types=1);

namespace Iteks\OpenAi\Contracts\Api\Assistants;

interface AssistantsInterface
{
    public function create(string $model, array $options = []): array;

    public function list(array $options = []): array;

    public function retrieve(string $assistant_id): array;

    public function modify(string $assistant_id, array $options = []): array;

    public function delete(string $assistant_id): array;
}
