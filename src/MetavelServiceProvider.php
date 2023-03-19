<?php

namespace Tombenevides\Metavel;

use Illuminate\Support\ServiceProvider;
use Tombenevides\Metavel\Components\Question;

class MetavelServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->loadComponents();

        $this->publishes([
            __DIR__ . '/config/metavel.php' => config_path('metavel.php'),
        ], 'metavel-config');
    }

    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/config/metavel.php', 'metavel');
    }

    protected function loadComponents(): void
    {
        $this->loadViewsFrom(__DIR__ . '/resources/views', 'metavel');
        $this->loadViewComponentsAs('metavel', $this->viewComponents());
    }

    protected function viewComponents(): array
    {
        return [
            Question::class
        ];
    }
}