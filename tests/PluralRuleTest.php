<?php

namespace SmoKE585\RUDeclensionLaravel\Tests;

use SmoKE585\RUDeclensionLaravel\Services\Rules\RussianPluralRule;

class PluralRuleTest extends TestCase
{
    public function test_rule(): void
    {
        $this->assertSame('one', RussianPluralRule::detect(1));
        $this->assertSame('few', RussianPluralRule::detect(2));
        $this->assertSame('few', RussianPluralRule::detect(4));
        $this->assertSame('many', RussianPluralRule::detect(5));
        $this->assertSame('many', RussianPluralRule::detect(11));
        $this->assertSame('many', RussianPluralRule::detect(14));
        $this->assertSame('one', RussianPluralRule::detect(21));
        $this->assertSame('few', RussianPluralRule::detect(22));
        $this->assertSame('many', RussianPluralRule::detect(25));
    }
}