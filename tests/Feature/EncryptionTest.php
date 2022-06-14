<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Crypt;
use Tests\TestCase;

class EncryptionTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testEncryption()
    {
        $encrypt =  Crypt::encrypt('Eko Budi');
        var_dump($encrypt);

        $decrypt = Crypt::decrypt($encrypt);

        self::assertEquals('Eko Budi', $decrypt);
    }
}
