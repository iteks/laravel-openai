<?php

declare(strict_types=1);

namespace Iteks\OpenAi\Contracts\Api\Assistants;

interface VectorStoreFilesInterface
{
    public function create(string $vector_store_id, string $file_id): array;

    public function list(string $vector_store_id, array $options = []): array;

    public function retrieve(string $vector_store_id, string $file_id): array;

    public function delete(string $vector_store_id, string $file_id): array;
}
