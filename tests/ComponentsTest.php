<?php

use Illuminate\Support\Facades\Blade;
use Tombenevides\Metavel\Tests\TestCase;

use function PHPUnit\Framework\assertStringContainsString;

uses(TestCase::class);

it('should find the components', function ($componentAlias) {
    $this->assertArrayHasKey($componentAlias, Blade::getClassComponentAliases());
})->with([
    'metavel-question',
    'metavel-dashboard',
]);

it('should render the component', function($componentName) {
    $component = "\Tombenevides\Metavel\Components\\".$componentName;

    $view = Blade::renderComponent(new $component(resource: 87));

    $this->assertStringContainsString(strtolower($componentName), $view);

})->with([
    'Question',
    'Dashboard',
]);

