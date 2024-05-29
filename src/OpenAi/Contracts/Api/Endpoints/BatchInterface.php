<?php

declare(strict_types=1);

namespace Iteks\OpenAi\Contracts\Api\Endpoints;

interface BatchInterface
{
    public function create(string $input_file_id, string $endpoint, string $completion_window, array $options = []): array;

    public function retrieve(string $batch_job_id): array;

    public function cancel(string $batch_job_id): array;

    public function list(array $options = []): array;
}
