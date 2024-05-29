<?php

declare(strict_types=1);

describe('Arch', function () {
    test('facades')
        ->expect('Iteks\Support\Facades\OpenAi')
        ->toOnlyUse([
            'Illuminate\Support\Facades\Facade',
            'Iteks\OpenAi\Api\Assistants\Assistants',
            'Iteks\OpenAi\Api\Assistants\Messages',
            'Iteks\OpenAi\Api\Assistants\Runs',
            'Iteks\OpenAi\Api\Assistants\RunSteps',
            'Iteks\OpenAi\Api\Assistants\Threads',
            'Iteks\OpenAi\Api\Assistants\VectorStoreFileBatches',
            'Iteks\OpenAi\Api\Assistants\VectorStoreFiles',
            'Iteks\OpenAi\Api\Assistants\VectorStores',
            'Iteks\OpenAi\Api\Endpoints\Audio',
            'Iteks\OpenAi\Api\Endpoints\Batch',
            'Iteks\OpenAi\Api\Endpoints\Chat',
            'Iteks\OpenAi\Api\Endpoints\Embeddings',
            'Iteks\OpenAi\Api\Endpoints\Files',
            'Iteks\OpenAi\Api\Endpoints\FineTuning',
            'Iteks\OpenAi\Api\Endpoints\Images',
            'Iteks\OpenAi\Api\Endpoints\Models',
            'Iteks\OpenAi\Api\Endpoints\Moderations',
            'Iteks\OpenAi\Api\Legacy\Completions',
        ]);

    test('service providers')
        ->expect('Iteks\Providers\OpenAiServiceProvider')
        ->toOnlyUse([
            'config',
            'config_path',
            'Illuminate\Support\ServiceProvider',
            'Iteks\Http\Client',
            'Iteks\OpenAi\Http\ApiClient',
        ]);
})->group('arch');
