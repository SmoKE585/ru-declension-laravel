<?php

namespace SmoKE585\RUDeclensionLaravel\Providers;

use Illuminate\Support\ServiceProvider;
use SmoKE585\RUDeclensionLaravel\Services\RUDeclensionManager;
use SmoKE585\RUDeclensionLaravel\Services\Dictionary\CompositeDictionary;
use SmoKE585\RUDeclensionLaravel\Services\Dictionary\ConfigDictionary;
use SmoKE585\RUDeclensionLaravel\Services\Dictionary\SqliteDictionary;

class RUDeclensionServiceProvider extends ServiceProvider
{
    private const CONFIG_KEY = 'ru-declension';

    public function register(): void
    {
        $this->mergeConfigFrom($this->packageRootPath('config/ru-declension.php'), self::CONFIG_KEY);

        $this->app->singleton('ru-declension', function ($app) {
            $config = (array) $app['config']->get(self::CONFIG_KEY, []);
            $sqlitePath = (string) ($config['sqlite_path'] ?? '');
            if ($sqlitePath === '') {
                $sqlitePath = $this->packageRootPath('resources/dict/ru_declension.sqlite');
            }

            $dictionary = new CompositeDictionary([
                new ConfigDictionary($config['user_dictionary'] ?? []),
                new SqliteDictionary($sqlitePath),
            ]);

            return new RUDeclensionManager(
                $dictionary,
                (bool) ($config['strict'] ?? false)
            );
        });
    }

    public function boot(): void
    {
        $this->publishes([
            $this->packageRootPath('config/ru-declension.php') => config_path('ru-declension.php'),
        ], 'ru-declension-config');
    }

    private function packageRootPath(string $path = ''): string
    {
        $root = dirname(__DIR__, 2);

        return $path === '' ? $root : $root . '/' . ltrim($path, '/');
    }
}
