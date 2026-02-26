<?php

namespace SmoKE585\RUDeclensionLaravel\Services\Dictionary;

class ConfigDictionary implements DictionaryInterface
{
    public function __construct(
        protected array $data = []
    ) {}

    public function get(string $word): ?array
    {
        if (!array_key_exists($word, $this->data)) {
            return null;
        }

        $forms = $this->data[$word];

        if (isset($forms['one'], $forms['few'], $forms['many'])) {
            return [
                'one' => (string) $forms['one'],
                'few' => (string) $forms['few'],
                'many' => (string) $forms['many'],
            ];
        }

        if (is_array($forms) && count($forms) >= 3) {
            return [
                'one' => (string) $forms[0],
                'few' => (string) $forms[1],
                'many' => (string) $forms[2],
            ];
        }

        return null;
    }
}
