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
     * Test new user sign up
     *
     * @return void
     * @return void
     */

    private $user;
    private $token;

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
    /**
     * Test existing user sign up
     *
     * @return void
     */
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

    /**
     * Test login - success
     *
     * @return void
     */
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
    /**
     * Test login unknnown email
     *
     * @return void
     */
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
    /**
     * Test login incorrect password
     *
     * @return void
     */
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
    /**
     * Test no credentials
     *
     * @return void
     */
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
    /**
     * Test login remember true
     *
     * @return void
     */
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
    /**
     * Test login remember false
     *
     * @return void
     */
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
    /**
     * Test logout
     *
     * @return void
     */
    public function testLogout()
    {
        $user = factory(User::class)->create();

        $token = $user->createToken('TestToken')->accessToken;

        $response = $this->withHeaders(['Authorization' => 'Bearer ' .$token])
                         ->get('api/auth/logout');
        $response
            ->assertStatus(200)
            ->assertJson([
                'logged_out' => true,
            ]);
    }
}
