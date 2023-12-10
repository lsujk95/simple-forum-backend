<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthTest extends TestCase
{
    private static string $token;

    /**
     * Tests user register function
     * @return void
     */
    public function test_user_register_function(): void
    {
        $response = $this->post('/api/auth/register', [
            'email' => 'test_user@gmail.com',
            'name' => 'test_user',
            'password' => 'test_password',
        ]);
        $response->assertStatus(200)
            ->assertJson([
                'success' => true,
            ]);
        $response->assertSee('token');
    }

    /**
     * Tests user login function
     * @return void
     */
    public function test_user_login_function(): void
    {
        $response = $this->post('/api/auth/get-token', [
            'email' => 'test_user@gmail.com',
            'password' => 'test_password',
        ]);
        $response->assertStatus(200)
            ->assertJson([
                'success' => true,
            ]);
        $response->assertSee('token');
        self::$token = $response['data']['token'];
        echo self::$token;
    }
}
