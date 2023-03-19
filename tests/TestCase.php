<?php

namespace Tombenevides\Metavel\Tests;

use Tombenevides\Metavel\MetavelServiceProvider;

class TestCase extends \Orchestra\Testbench\TestCase
{
    protected function getPackageProviders($app)
    {
        return [MetavelServiceProvider::class];
    }
}