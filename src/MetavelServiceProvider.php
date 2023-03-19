<?php

namespace Tombenevides\Metavel;

use Illuminate\Support\ServiceProvider;
use Tombenevides\Metavel\Components\Question;

class MetavelServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->loadViewComponentsAs('metavel', $this->viewComponents());
    }

    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/config/metavel.php', 'metavel');
    }

    protected function viewComponents(): array
    {
        return [
            Question::class
        ];
    }
}