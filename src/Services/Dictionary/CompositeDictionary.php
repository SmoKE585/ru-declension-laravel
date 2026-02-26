<?php

namespace SmoKE585\RUDeclensionLaravel\Services\Dictionary;

class CompositeDictionary implements DictionaryInterface
{
    public function __construct(
        protected array $sources = []
    ) {}

    public function get(string $word): ?array
    {
        foreach ($this->sources as $source) {
            if (!$source instanceof DictionaryInterface) {
                continue;
            }

            $result = $source->get($word);
            if ($result) {
                return $result;
            }
        }

        return null;
    }
}
