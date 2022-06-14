<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ResponseControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testResponse()
    {
       $this->get('/response/hello')
        ->assertStatus(200)
        ->assertSeeText('Hello Response');
    }

    public function testHeader()
    {
        $this->get('/response/header')
        ->assertStatus(200)
        ->assertSeeText('Eko')->assertSeeText('Budi')
        ->assertHeader('Content-Type', 'aplication/json')
        ->assertHeader('Author', 'Programmer Zaman Now')
        ->assertHeader('App', 'Belajar Laravel');
    }


    public function testView()
    {
        $this->get('/response/type/view')
            ->assertSeeText('Hello Eko');
    }

    public function testJson()
    {
        $this->get('/response/type/json')
            ->assertJson([
                'FirstName' => 'Eko',
            'LastName' => 'Budi'
            ]);
    }

    public function testFile()
    {
        $this->get('/response/type/file')
            ->assertHeader('Content-Type', 'image/png');
    }

    public function testDownload()
    {
        $this->get('/response/type/download')
            ->assertDownload('ekobudi.png');
    }
    
}
