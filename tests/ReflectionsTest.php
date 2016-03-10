<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ReflectionTest extends TestCase
{
    /**
     * Verify reflection for `trim`.
     *
     * @return void
     */
    public function testTrimResource()
    {
        $this->get('/reflections/trim')
             ->seeJsonEquals([
                 'name' => 'trim',
                 'type' => 'function'
             ]);
    }
}
