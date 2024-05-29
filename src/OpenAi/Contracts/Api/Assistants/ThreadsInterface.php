<?php

declare(strict_types=1);

namespace Iteks\OpenAi\Contracts\Api\Assistants;

interface ThreadsInterface
{
    public function create(array $options = []): array;

    public function retrieve(string $thread_id): array;

    public function modify(string $thread_id, array $options = []): array;

    public function delete(string $thread_id): array;
}
