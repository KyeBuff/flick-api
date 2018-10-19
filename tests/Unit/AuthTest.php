<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Carbon\Carbon;
use App\User;
use Illuminate\Support\Facades\Auth;

class AuthTest extends TestCase
{
    /**
     * Test user sign up
     *
     * @return void
     */
    public function testNewUserSignUp()
    {
    	$response = $this->json('POST', 'api/auth/signup', [
		   "name" => "Kye Buffery",
		   "email" => "kye@user.com",
		   "password" => "password",
		   "password_confirmation" => "password"
    	]);

        $response
            ->assertStatus(201)
            ->assertJson([
                'created' => true,
            ]);
    }

    public function testExistingUserSignUp()
    {
    	$response = $this->json('POST', 'api/auth/signup', [
		   "name" => "Kye Buffery",
		   "email" => "kye@user.com",
		   "password" => "password",
		   "password_confirmation" => "password"
    	]);

        $response
            ->assertStatus(201)
            ->assertJson([
                'created' => true,
            ]);
    }


    public function testLoginSuccess()
    {
        $response = $this->json('POST', 'api/auth/login', [
           "email" => "kye@user.com",
           "password" => "password",
           "remember_me" => false,
        ]);

        $response
            ->assertStatus(200)
            ->assertJson([
                'access_token' => true,
                'token_type' => 'Bearer',
                "expires_at" => true
            ]);
    }

    public function testLoginUnknownEmail()
    {
        $response = $this->json('POST', 'api/auth/login', [
           "email" => "unknown@user.com",
           "password" => "password",
           "remember_me" => false,
        ]);

        $response
            ->assertStatus(401)
            ->assertJson([
                'message' => "Unauthorized"
            ]);
    }

    public function testLoginIncorrectPassword()
    {
        $response = $this->json('POST', 'api/auth/login', [
           "email" => "kye@user.com",
           "password" => "incorrect",
           "remember_me" => false,
        ]);

        $response
            ->assertStatus(401)
            ->assertJson([
                'message' => "Unauthorized"
            ]);
    }

    public function testNoCredentials()
    {
        $response = $this->json('POST', 'api/auth/login', [
           "email" => "",
           "password" => "",
           "remember_me" => false,
        ]);

        $response
            ->assertStatus(401)
            ->assertJson([
                'message' => "Unauthorized"
            ]);
    }

    public function testLoginRemember()
    {
        $response = $this->json('POST', 'api/auth/login', [
           "email" => "kye@user.com",
           "password" => "password",
           "remember_me" => true,
        ]);

        $response
            ->assertStatus(200)
            ->assertJson([
                'access_token' => true,
                'token_type' => 'Bearer',
                "expires_at" => Carbon::now()->addWeeks(1)
            ]);

    }

    public function testLoginDontRemember()
    {
        $response = $this->json('POST', 'api/auth/login', [
           "email" => "kye@user.com",
           "password" => "password",
           "remember_me" => false,
        ]);

        $response
            ->assertStatus(200)
            ->assertJson([
                'access_token' => true,
                'token_type' => 'Bearer',
                "expires_at" => Carbon::now()->addHours(2)
            ]);
    }

    public function testLogout()
    {
        $user = factory(User::class)->create();

        Auth::login($user);

        $response = $this->actingAs($user, 'api')
                         ->get('api/auth/logout');

        $response
            ->assertStatus(200)
            ->assertJson([
                'logged_out' => true,
            ]);
    }
}
