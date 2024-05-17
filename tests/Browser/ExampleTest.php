<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use Throwable;

class ExampleTest extends DuskTestCase
{
    /**
     * A basic browser test example.
     * @throws Throwable
     */
    public function testBasicExample(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                    ->assertSee('We are in IT together Conference');
        });
    }
}
