<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ViewTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testView()
    {
        $this->get('/hello')
            ->assertSeeText('Hello Eko');
        $this->get('/hello-again')
            ->assertSeeText('Hello Budi');
    }


    public function testNested()
    {
        $this->get('/hello-world')
        ->assertSeeText('World Budi');
    }

    public function testTemplate()
    {
        $this->view('hello', ['name' => 'Eko'])
            ->assertSeeText('Hello Eko');
        $this->view('hello.world', ['name' => 'Eko'])
            ->assertSeeText('World Eko');
    }

    public function testParameter()
    {
        $this->get('/products/1')
        ->assertSeeText('Product 1');
        $this->get('/products/2')
        ->assertSeeText('Product 2');
        $this->get('/products/1/items/eko')
        ->assertSeeText('Product 1, Item eko');
        $this->get('/products/2/items/budi')
        ->assertSeeText('Product 2, Item budi');
    }

    public function testParameterRegex()
    {
        $this->get('/categories/1')
            ->assertSeeText('Category 1');
        $this->get('/categories/eko')
            ->assertSeeText('404 By Eko Budi S');
    }

    public function testRouteParameterOptional()
    {
        $this->get('/users/eko')
            ->assertSeeText('User eko');
        $this->get('/users')
            ->assertSeeText('User 404');
    }

    public function testRouteConflict()
    {
        $this->get('/conflict/budi')
            ->assertSeeText('Conflict budi');

        $this->get('/conflict/eko')
            ->assertSeeText('Conflict Eko Budi');
    }

    public function testNamedRoute()
    {
        $this->get('/produk/12345')
            ->assertSeeText('Link http://laravel-pzn.test/products/12345');

        $this->get('/produk-redirect/12345')
            ->assertRedirect('/products/12345');
    }
}
