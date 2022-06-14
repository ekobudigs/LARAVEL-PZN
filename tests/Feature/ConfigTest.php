<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ConfigTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testConfig()
    {
       $firstName = config('contoh.author.first');
       $lastName = config('contoh.author.last');
       $email = config('contoh.email');
       $web = config('contoh.web');


       self::assertEquals('Eko', $firstName);
       self::assertEquals('Budi', $lastName);
       self::assertEquals('ekobudi029@gmail.com', $email);
       self::assertEquals('ngadomurah.com', $web);
    }
}
