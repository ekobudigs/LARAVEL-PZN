<?php

namespace Tests\Feature;

use App\Data\Foo;
use App\Data\Bar;
use App\Data\Person;
use App\Services\HelloService;
use App\Services\HelloServiceIndonesia;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ServiceContainerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testServiceContainer()
    {
        $foo1 = $this->app->make(Foo::class);
        $foo2 = $this->app->make(Foo::class);

        self::assertEquals('Foo', $foo1->foo());
        self::assertEquals('Foo', $foo2->foo());
        self::assertSame($foo1, $foo2);
    }

    public function testBind()
    {
        // $person = $this->app->make(Person::class);
        // self::assertNotNull($person);

        $this->app->bind(Person::class, function ($app){
            return new Person('Eko', 'Budi');
        });

        $person1 = $this->app->make(Person::class);
        $person2 = $this->app->make(Person::class);

        self::assertEquals('Eko', $person1->firstname);
        self::assertEquals('Eko', $person2->firstname);
        self::assertNotSame($person1, $person2);
    }


    public function testSingleton()
    {

        $this->app->singleton(Person::class, function ($app){
            return new Person('Eko', 'Budi');
        });

        $person1 = $this->app->make(Person::class);
        $person2 = $this->app->make(Person::class);

        self::assertEquals('Eko', $person1->firstname);
        self::assertEquals('Eko', $person2->firstname);
        self::assertSame($person1, $person2);
    }


    public function testIstance()
    {
        $person = new Person("Eko", "Budi");

        $this->app->instance(Person::class, $person);

        $person1 = $this->app->make(Person::class);
        $person2 = $this->app->make(Person::class);
        $person3 = $this->app->make(Person::class);
        $person4 = $this->app->make(Person::class);

        self::assertEquals('Eko', $person1->firstname);
        self::assertEquals('Eko', $person2->firstname);
        self::assertSame($person1, $person2);
    }


    public function testDependencyInjection()
    {
        $this->app->singleton(Foo::class, function ($app) {
            return new Foo();
        });

        $foo = $this->app->make(Foo::class);
        $bar = $this->app->make(Bar::class);

        self::assertSame($foo, $bar->foo);
    }


    public function testDependencyInjectionClousur()
    {
        $this->app->singleton(Foo::class, function ($app) {
            return new Foo();
        });
        $this->app->singleton(Bar::class, function ($app) {
            $foo = $app->make(Foo::class);
            return new Bar($foo);
        });

        $foo = $this->app->make(Foo::class);
        $bar1 = $this->app->make(Bar::class);
        $bar2 = $this->app->make(Bar::class);

        self::assertSame($foo, $bar1->foo);
        self::assertSame($bar1, $bar2);
    }

    public function testInterfaceToClass()
    {
        $this->app->singleton(HelloService::class, HelloServiceIndonesia::class);

        $helloService = $this->app->make(HelloService::class);

        self::assertEquals('Hallo Eko', $helloService->hello('Eko'));
    }

    public function testInterfaceToClassClousur()
    {
        //kalo komplek saran pakai ini
        $this->app->singleton(HelloService::class, function ($app){
            return new HelloServiceIndonesia();
        });

        $helloService = $this->app->make(HelloService::class);

        self::assertEquals('Hallo Eko', $helloService->hello('Eko'));
    }
}
