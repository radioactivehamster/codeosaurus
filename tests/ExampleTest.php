<?php

use Httpful\Request;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ExampleTest extends TestCase
{
    /**
     * A basic functional test example.
     *
     * @return void
     */
    public function testBasicExample()
    {
        $this->visit('/')
             ->see('Laravel 5');
    }

    /**
     * Tests that JSON exceptions are being thrown appropriately in debug mode.
     *
     * @return void
     */
    public function testDebugJsonExceptions()
    {
        if (!config('app.debug')) {
            return;
        }

        $url      = config('app.url') . '/page-that-doesnt-exist-for-sure-101010292929883833921010101x2-for-cereal';
        $response = Request::get($url)->expectsJson()->send();
        $json     = $response->body;

        $this->assertTrue(property_exists($json, 'error'));
        $this->assertTrue(property_exists($json->error, 'type'));
        $this->assertTrue(property_exists($json->error, 'message'));
        $this->assertTrue(property_exists($json->error, 'file'));
        $this->assertTrue(property_exists($json->error, 'line'));
    }
}
