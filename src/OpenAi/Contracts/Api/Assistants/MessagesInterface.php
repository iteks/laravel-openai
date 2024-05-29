<?php

declare(strict_types=1);

namespace Iteks\OpenAi\Contracts\Api\Assistants;

interface MessagesInterface
{
    public function create(string $thread_id, string $role, string $content, array $options = []): array;

    public function list(string $thread_id, array $options = []): array;

    public function retrieve(string $thread_id, string $message_id): array;

    public function modify(string $thread_id, string $message_id, array $options = []): array;

    public function delete(string $thread_id, string $message_id): array;
}
