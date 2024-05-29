<?php

declare(strict_types=1);

namespace Iteks\OpenAi\Contracts\Api\Assistants;

interface RunStepsInterface
{
    public function list(string $thread_id, string $run_id, array $options = []): array;

    public function retrieve(string $thread_id, string $run_id, string $step_id): array;
}
