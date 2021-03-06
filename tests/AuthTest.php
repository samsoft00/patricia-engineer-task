<?php

use App\Models\User;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthTest extends TestCase
{
    /**
     * Test user registration
     * @return void
     */
    public function testUserRegistration()
    {
        $index = rand(50, 100);
        $email = "john" . $index . "@doe.com";
        var_dump($email);
        $this->post(
            "/api/register",
            [
                "name" => "John Doe",
                "email" => $email,
                "password" => "password",
                "password_confirmation" => "password"
            ],
        );

        $this->assertEquals(200, $this->response->status());
    }

    /**
     * Test incorrect password.
     * @return void
     */
    public function testShouldFailIfPasswordIncorrect()
    {
        $email = 'john1@doe.com';
        $password = 'password1';

        $response = $this->call(
            "POST",
            "/api/login",
            ["email" => $email, "password" => $password]
        );

        $response
            ->assertStatus(401);
    }

    /**
     * Test should return success id cred are correct
     * @return void
     */
    public function testShouldReturnSuccess()
    {
        $email = 'john1@doe.com';
        $password = 'password';

        $response = $this->call(
            "POST",
            "/api/login",
            ["email" => $email, "password" => $password]
        );

        $response
            ->assertStatus(200)
            ->assertJsonStructure([
                'access_token', 'token_type', 'expires_in'
            ]);
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testTokenRefresh()
    {
        $user = User::where('email', 'john1@doe.com')->first();
        $token = JWTAuth::fromUser($user);

        $this->get(
            "/api/refresh-token",
            ["Authorization" => "bearer $token"]
        );

        $this->assertEquals(200, $this->response->status());
    }
}
