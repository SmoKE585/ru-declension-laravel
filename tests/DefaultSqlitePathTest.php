<?php

namespace SmoKE585\RUDeclensionLaravel\Tests;

class DefaultSqlitePathTest extends TestCase
{
    public function test_it_uses_bundled_sqlite_when_path_is_null(): void
    {
        $this->app['config']->set('ru-declension.sqlite_path', null);
        $this->app['config']->set('ru-declension.user_dictionary', []);

        $manager = $this->app->make('ru-declension');

        $this->assertSame('2 дня', $manager->make(2, 'день'));
    }
}
