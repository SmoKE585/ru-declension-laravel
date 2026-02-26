<?php

namespace SmoKE585\RUDeclensionLaravel\Services\Rules;

class RussianPluralRule
{
    public static function detect(int|float|string $number): string
    {
        $n = abs((int) $number);

        $mod100 = $n % 100;
        $mod10  = $n % 10;

        if ($mod100 >= 11 && $mod100 <= 14) {
            return 'many';
        }

        if ($mod10 === 1) {
            return 'one';
        }

        if ($mod10 >= 2 && $mod10 <= 4) {
            return 'few';
        }

        return 'many';
    }
}