<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RoutingTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testGet()
    {
        $this->get('/pzn')
        ->assertStatus(200)
        ->assertSeeText('Eko Budi S');
    }

    public function testRedirect()
    {
        $this->get('/youtube')
         ->assertRedirect('/pzn');
    }

    public function testFallback()
    {
        $this->get('tidakada')
        ->assertSeeText('404 By Eko Budi S');
    }
}
