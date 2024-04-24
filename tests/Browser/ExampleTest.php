<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class ExampleTest extends DuskTestCase
{
    /**
     * A basic browser test example.
     */
    public function testBasicExample(): void
    {
//        @dd($_ENV);
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                    ->assertSee('We are in IT together Conference');
        });
    }
}
