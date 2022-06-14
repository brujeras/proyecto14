<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class ExampleTest extends DuskTestCase
{
    /**
     * A basic browser test example.
     *
     * @return void
     */
    public function testBasicExample()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                ->pause(1000)
                ->assertSee('Categorías')
                ->click('@category-button')
                    ->screenshot('example-test');
        });
    }
    /** @test */
    public function pressCategoryButtonAndDisplay()
    {
        $this->browse(function (Browser $browser){
           $browser->visit('/')
               ->pause(1000)
               ->assertSeeLink('Categorías')
           ->screenshot('categoria-test');
        });
    }

    /** @test */
    public function mouseClickOnCategoriesAndSubcategories()
    {
        $this->browse(function (Browser $browser){
            $browser->visit('/')
                ->assertSeeLink('Categorías')
                ->click('@category-button')
                ->assertSee('Celulares y smartphones')
                ->pause(1000)
                ->screenshot('categorias-test');
        });
    }
}
