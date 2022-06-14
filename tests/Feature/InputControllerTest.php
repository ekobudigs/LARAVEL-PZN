<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class InputControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testInput()
    {
        $this->get('/input/hello?name=12')
            ->assertSeeText('Hello 12');

        $this->post('/input/hello', [
            'name' => 'eko'
        ])->assertSeeText('Hello eko');
    }

    public function testNestedInput()
    {
        $this->post('/input/hello/first', [
            'name' => [
                'first' => 'eko'
            ]
        ])->assertSeeText('Hello eko');
    }


    public function testInputAll()
    {
        $this->post('/input/hello/input', [
            'name' => [
                'first' => 'eko',
                'last' => 'budi'
            ]
        ])->assertSeeText('name')->assertSeeText('first')->assertSeeText('last')
        ->assertSeeText('eko')->assertSeeText('budi');
    }


    public function testInputArray()
    {
        $this->post('/input/hello/array', [
            "products" => [
                [
                    "name" => "Apple Mac Book Pro",
                    "price" => 400000
                ],
                [
                    "name" => "Samsung Galaxy S10",
                    "price" => 350000
                ]
            ]
        ])->assertSeeText("Apple Mac Book Pro")
         ->assertSeeText("Samsung Galaxy S10");
    }


    public function testInputType()
    {
        $this->post('/input/type', [
            "name" => "Eko",
            "married" => "false",
            "birth_day" => "1998-10-18"
        ])->assertSeeText("Eko")->assertSeeText("false")->assertSeeText("1998-10-18");
    }


    public function testFilterOnly()
    {
        $this->post('/input/filter/only', [
            "name" => [
                "first" => "eko",
                "middle" => "admin",
                "last" => "budi"
            ]
        ])->assertSeeText("eko")->assertSeeText("budi")->assertDontSeeText("admin");
    }

    public function testFilterExcept()
    {
        $this->post('/input/filter/except',
            [
                "username" => "budi",
                "password" => "kepo",
                "admin" => true
            ]
        )->assertSeeText("kepo")->assertSeeText("budi")->assertDontSeeText("admin");
    }

    public function testFilterMerge()
    {
        $this->post('/input/filter/merge',
            [
                "username" => "budi",
                "password" => "kepo",
                "admin" => "true"
            ]
        )->assertSeeText("kepo")->assertSeeText("budi")->assertSeeText("admin")->assertSeeText("false");
    }
}
