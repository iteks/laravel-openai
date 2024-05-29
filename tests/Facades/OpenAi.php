<?php

declare(strict_types=1);

use Iteks\OpenAi\Http\ApiClient;
use Iteks\Providers\OpenAiServiceProvider;
use Iteks\Support\Facades\OpenAi;

describe('Facade', function () {
    it('resolves facades', function () {
        $app = app();

        // Register and boot the service provider.
        (new OpenAiServiceProvider($app))->register();
        (new OpenAiServiceProvider($app))->boot();

        // Set the facade application.
        OpenAi::setFacadeApplication($app);

        // Check that the facade resolves to the ApiClient.
        expect(OpenAi::getFacadeRoot())->toBeInstanceOf(ApiClient::class);
    });
})->group('facade');
