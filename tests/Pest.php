<?php

declare(strict_types=1);

use Illuminate\Config\Repository as ConfigRepository;
use Illuminate\Filesystem\FilesystemServiceProvider;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Facade;
use Iteks\Providers\OpenAiServiceProvider;

uses()->beforeEach(function () {
    // Create a fresh copy of the application for each test.
    $app = new Application(realpath(__DIR__.'/../'));

    // Register the configuration repository.
    $app->instance('config', new ConfigRepository(require __DIR__.'/../config/openai.php'));

    // Enable facades.
    Facade::setFacadeApplication($app);

    // Manually register the FilesystemServiceProvider.
    $app->register(FilesystemServiceProvider::class);

    // Manually register the package's service provider.
    $app->register(OpenAiServiceProvider::class);

    // Boot the application.
    $app->boot();

    // Set the application instance for the test
    $this->app = $app;
})->in('Facades', 'Unit');
