<?php

declare(strict_types=1);

namespace Iteks\OpenAi\Contracts\Api\Assistants;

interface VectorStoreFileBatchesInterface
{
    public function create(string $vector_store_id, array $file_ids): array;

    public function retrieve(string $vector_store_id, string $batch_id): array;

    public function cancel(string $vector_store_id, string $batch_id): array;

    public function list(string $vector_store_id, string $batch_id, array $options = []): array;
}
