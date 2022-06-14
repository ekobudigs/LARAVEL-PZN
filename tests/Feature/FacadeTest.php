<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Config;
use Tests\TestCase;

class FacadeTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testConfig()
    {
        $firstname1 = config('contoh.author.first');
        $firstname2 = Config::get('contoh.author.first');

        self::assertEquals($firstname1, $firstname2);
    }


    public function testConfigDependency()
    {
        $config = $this->app->make('config');
        $firstname3 = $config->get('contoh.author.first');


        $firstname1 = config('contoh.author.first');
        $firstname2 = Config::get('contoh.author.first');

        self::assertEquals($firstname1, $firstname2);
        self::assertEquals($firstname1, $firstname3);
    }

    public function testFacadeMock()
    {   
        Config::shouldReceive('get')
            ->with('contoh.author.first')
            ->andReturn('Eko Keren');


        $firstname = Config::get('contoh.author.first');

        self::assertEquals('Eko Keren', $firstname);
    }
}
