<?php

declare(strict_types=1);

use Iteks\OpenAi\Http\ApiClient;
use Iteks\Providers\OpenAiServiceProvider;
use Iteks\Support\Facades\OpenAi;

describe('Service Provider', function () {
    it('registers the openai service on the container', function () {
        $app = app();

        (new OpenAiServiceProvider($app))->register();

        expect($app->get(OpenAi::class))->toBeInstanceOf(OpenAi::class);
    });

    it('registers the openai service on the container as singleton', function () {
        $app = app();

        (new OpenAiServiceProvider($app))->register();

        $enum = $app->get(OpenAi::class);

        expect($enum)->toBeInstanceOf(OpenAi::class);
    });

    it('provides', function () {
        $app = app();

        $provides = (new OpenAiServiceProvider($app))->provides();

        expect($provides)->toBe([
            'open.ai',
            ApiClient::class,
        ]);
    });
})->group('service-provider');
