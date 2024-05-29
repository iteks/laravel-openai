<?php

declare(strict_types=1);

namespace Iteks\OpenAi\Contracts\Api\Endpoints;

interface FilesInterface
{
    public function create(mixed $file, string $purpose): array;

    public function list(array $options = []): array;

    public function retrieve(string $file_id): array;

    public function delete(string $file_id): array;

    public function retrieveContents(string $file_id): string;
}
