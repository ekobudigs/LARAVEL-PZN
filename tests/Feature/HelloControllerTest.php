<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class HelloControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testHello()
    {
       $this->get('/controller/hello/eko')
        ->assertSeeText('Hallo eko');
    }

    public function testRequest()
    {
        $this->get('/controller/hello/request', [
            "Accept" => "plaint/text"
        ])->assertSeeText("controller/hello/request")
        ->assertSeeText("http://laravel-pzn.test/controller/hello/request")
        ->assertSeeText("GET")
        ->assertSeeText("plaint/text");
    }
}
