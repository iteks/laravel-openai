<?php

declare(strict_types=1);

namespace Iteks\OpenAi\Contracts\Api\Assistants;

interface VectorStoresInterface
{
    public function create(array $options = []): array;

    public function list(array $options = []): array;

    public function retrieve(string $vector_store_id): array;

    public function modify(string $vector_store_id, array $options = []): array;

    public function delete(string $vector_store_id): array;
}
