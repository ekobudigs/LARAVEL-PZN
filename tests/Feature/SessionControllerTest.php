<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SessionControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testcreateSession()
    {
      $this->get('/session/create')
      ->assertSeeText('OK')
      ->assertSessionHas('userId', 'Eko')
      ->assertSessionHas('isMember', true);
    }

    public function testGetSession()
    {
        $this->withSession([
          "userId" => "Khannedy",
          "isMember" => true
        ])->get('/session/get')
        ->assertSeeText('User Id : Khannedy, Is Member : 1');
    }
    public function testGetSessionfailed()
    {
        $this->withSession([])->get('/session/get')
        ->assertSeeText('User Id : guest, Is Member : 1');
    }
}
