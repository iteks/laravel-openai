<?php

declare(strict_types=1);

namespace Iteks\OpenAi\Contracts\Api\Endpoints;

interface FineTuningInterface
{
    public function create(string $model, string $training_file, array $options = []): array;

    public function list(array $options = []): array;

    public function listEvents(string $fine_tuning_job_id, array $options = []): array;

    public function listCheckpoints(string $fine_tuning_job_id, array $options = []): array;

    public function retrieve(string $fine_tuning_job_id, array $options = []): array;

    public function cancel(string $fine_tuning_job_id, array $options = []): array;
}
