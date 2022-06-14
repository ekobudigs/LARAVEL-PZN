<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UrlGenerationTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testUrlCurrent()
    {
        $this->get('/url/current?name=eko')
            ->assertSeeText('/url/current?name=eko');
    }

    public function testNamed()
    {
        $this->get('redirect/named')
            ->assertSeeText('redirect/name/eko');
    }

    public function testUrlAction()
    {
        $this->get('/url/action')
            ->assertSeeText('/form');
    }
}
