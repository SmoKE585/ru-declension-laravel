<?php

namespace SmoKE585\RUDeclensionLaravel\Facades;

use Illuminate\Support\Facades\Facade;
use SmoKE585\RUDeclensionLaravel\Services\RUDeclensionManager;

class RUDeclension extends Facade
{
    public const MODE_PHRASE = RUDeclensionManager::MODE_PHRASE;
    public const MODE_WORD = RUDeclensionManager::MODE_WORD;

    protected static function getFacadeAccessor(): string
    {
        return 'ru-declension';
    }
}
