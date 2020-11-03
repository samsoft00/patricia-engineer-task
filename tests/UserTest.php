<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class UserTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testShouldReturnUsers()
    {
        $response = $this->call("GET", "/api/users");

        $response
            ->assertStatus(200)
            ->assertJsonStructure([
                "users"
            ]);
    }
}
