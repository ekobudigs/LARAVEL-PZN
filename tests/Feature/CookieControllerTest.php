<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use phpDocumentor\Reflection\Types\This;
use Tests\TestCase;

class CookieControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testCookie()
    {
        $this->get('/cookie/set')
        ->assertSeeText('Hello Cookie')
        ->assertCookie('User-Id', 'eko')
        ->assertCookie('Is-Member', 'true');
    }

    public function testGetCookie()
    {
        $this->withCookie('User-Id', 'Eko')
        ->withCookie('Is-Member', 'true')
        ->get('/cookie/get')
        ->assertJson([
            'userId' => 'Eko',
            'isMember' => 'true'
        ]);
    }
}
