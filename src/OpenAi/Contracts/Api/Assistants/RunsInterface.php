<?php

declare(strict_types=1);

namespace Iteks\OpenAi\Contracts\Api\Assistants;

interface RunsInterface
{
    public function create(string $thread_id, string $assistant_id, array $options = []): array;

    public function createThreadAndRun(string $assistant_id, array $options = []): array;

    public function list(string $thread_id, array $options = []): array;

    public function retrieve(string $thread_id, string $run_id): array;

    public function modify(string $thread_id, string $run_id, array $options = []): array;

    public function submitToolOutputs(string $thread_id, string $run_id, array $tool_outputs, array $options = []): array;

    public function cancel(string $thread_id, string $run_id): array;
}
