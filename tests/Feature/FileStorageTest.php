<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class FileStorageTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testStorage()
    {
        $filesystem = Storage::disk("local");

        $filesystem->put("file.txt", "EKo Buid S");

        $content = $filesystem->get("file.txt");

        self::assertEquals("EKo Buid S", $content);
    }
}
