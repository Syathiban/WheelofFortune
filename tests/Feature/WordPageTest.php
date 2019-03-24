<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class WordPageTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function test_word()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/laravel/WheelofFortune/resources/views/words/index.blade.php')
                    ->press('Delete');
                    
        });
    }
}
