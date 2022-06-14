<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

    /** @test */
class EnviromentTest extends TestCase
{
    /** @test */

    public function getEnv()
    {
        $youtube = env('YOUTUBE');

        self::assertEquals('EKO BUDI S', $youtube);
    }

    public function TestDeafultEnv()
    {   
        $author =  env('AUTHOR', 'EKO');

        self::assertEquals('EKO', $author);
    }
}
