<?php

namespace SmoKE585\RUDeclensionLaravel\Tests;

use Illuminate\Support\Facades\Config;
use SmoKE585\RUDeclensionLaravel\Facades\RUDeclension;

class FacadeTest extends TestCase
{
    public function test_make_phrase_and_word(): void
    {
        $this->assertSame('3 балла', RUDeclension::make(3, 'балл'));
        $this->assertSame('3 балла', RUDeclension::make('балл', 3));
        $this->assertSame('балла', RUDeclension::make(3, 'балл', RUDeclension::MODE_WORD));
    }

    public function test_helper_function(): void
    {
        $this->assertSame('5 баллов', RUDeclension(5, 'балл'));
    }

    public function test_user_dictionary_has_priority_over_sqlite(): void
    {
        Config::set('ru-declension.user_dictionary', [
            'день' => ['денька', 'деньки', 'деньков'],
        ]);

        $manager = $this->app->make('ru-declension');

        $this->assertSame('2 деньки', $manager->make(2, 'день'));
    }
}
