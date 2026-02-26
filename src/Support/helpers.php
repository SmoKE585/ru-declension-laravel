<?php

use SmoKE585\RUDeclensionLaravel\Facades\RUDeclension as RUDeclensionFacade;
use SmoKE585\RUDeclensionLaravel\Services\RUDeclensionManager;

if (!function_exists('RUDeclension')) {
    function RUDeclension(mixed $a, mixed $b = null, int $mode = RUDeclensionManager::MODE_PHRASE): string
    {
        return RUDeclensionFacade::make($a, $b, $mode);
    }
}
