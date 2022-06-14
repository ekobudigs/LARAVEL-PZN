<?php

namespace App\Services;

class HelloServiceIndonesia implements HelloService

{
    public function hello(String $name): string

    {
        return "Hallo $name";
    }
    
}