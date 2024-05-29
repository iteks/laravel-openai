<?php

declare(strict_types=1);

namespace Iteks\Providers;

use Illuminate\Support\ServiceProvider;
use Iteks\Http\Client;
use Iteks\OpenAi\Http\ApiClient;

class OpenAiServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../../config/openai.php', 'openai');

        $this->app->singleton('open.ai', function ($app) {
            return new ApiClient(new Client(config('openai.api_key')));
        });
    }

    public function boot(): void
    {
        $this->publishes([
            __DIR__.'/../../config/openai.php' => config_path('openai.php'),
        ]);
    }

    public function provides(): array
    {
        return [
            'open.ai',
            ApiClient::class,
        ];
    }
}
