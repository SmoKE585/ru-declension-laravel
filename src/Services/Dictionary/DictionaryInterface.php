<?php

namespace SmoKE585\RUDeclensionLaravel\Services\Dictionary;

interface DictionaryInterface
{
    public function get(string $word): ?array;
}
