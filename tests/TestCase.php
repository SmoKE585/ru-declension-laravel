<?php

namespace SmoKE585\RUDeclensionLaravel\Tests;

use Orchestra\Testbench\TestCase as Orchestra;
use SmoKE585\RUDeclensionLaravel\Providers\RUDeclensionServiceProvider;

class TestCase extends Orchestra
{
    protected function getPackageProviders($app): array
    {
        return [RUDeclensionServiceProvider::class];
    }

    protected function defineEnvironment($app): void
    {
        $app['config']->set('ru-declension.strict', false);
        $app['config']->set('ru-declension.user_dictionary', [
            'балл' => ['балл', 'балла', 'баллов'],
        ]);
        $app['config']->set('ru-declension.sqlite_path', __DIR__ . '/fixtures/test.sqlite');
    }
}
