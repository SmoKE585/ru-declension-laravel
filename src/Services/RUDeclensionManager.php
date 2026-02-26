<?php

namespace SmoKE585\RUDeclensionLaravel\Services;

use SmoKE585\RUDeclensionLaravel\Services\Dictionary\CompositeDictionary;
use SmoKE585\RUDeclensionLaravel\Services\Rules\RussianPluralRule;

class RUDeclensionManager
{
    public const MODE_PHRASE = 0;
    public const MODE_WORD = 1;

    public function __construct(
        protected CompositeDictionary $dictionary,
        protected bool $strict = false
    ) {}

    public function make(mixed $a, mixed $b = null, int $mode = self::MODE_PHRASE): string
    {
        [$number, $word] = $this->normalizeArguments($a, $b);

        $forms = $this->dictionary->get($word);

        if (!$forms) {
            if ($this->strict) {
                return '';
            }

            $form = $word;
        } else {
            $case = RussianPluralRule::detect($number);
            $form = $forms[$case] ?? $word;
        }

        if ($mode === self::MODE_WORD) {
            return $form;
        }

        return trim($number . ' ' . $form);
    }

    protected function normalizeArguments(mixed $a, mixed $b): array
    {
        if (is_numeric($a) && is_string($b)) {
            return [(int) $a, $b];
        }

        if (is_numeric($b) && is_string($a)) {
            return [(int) $b, $a];
        }

        if (is_numeric($a) && $b === null) {
            return [(int) $a, ''];
        }

        return [(int) $a, (string) $b];
    }
}
