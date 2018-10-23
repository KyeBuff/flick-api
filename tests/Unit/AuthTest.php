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
    private $headers = [
        "Accept" => "application/json",
        "Content-Type" => "application/json",
        "Authorization" => null
    ];

    private $newUser = [
       "name" => "Kye Buffery",
       "email" => "kye@user.com",
       "password" => "password",
       "password_confirmation" => "password"
    ];


    private function createAuthenticatedUser() 
    {
        $this->user = factory(User::class)->create();
        $this->token =  $this->user->createToken('TestToken')->accessToken;
        $this->headers['Authorization'] = 'Bearer ' . $this->token;
    }

    public function testNewUserSignUp()
    {
    	$response = $this->json('POST', 'api/auth/signup', $this->newUser);

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
        $this->testNewUserSignUp();

    	$response = $this->json('POST', 'api/auth/signup', $this->newUser);

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
        $this->testNewUserSignUp();

        $user = $this->newUser;

        unset($user['password_confirmation']);
        unset($user['name']);

        $response = $this->json('POST', 'api/auth/login', $user);

        $response
            ->assertStatus(200)
            ->assertJson([
                'access_token' => true,
                'token_type' => 'Bearer',
                "expires_at" => true
            ]);
    }
    /**
     * Test login unknown email
     *
     * @return void
     */
    public function testLoginUnknownEmail()
    {
        $this->testNewUserSignUp();

        $this->testNewUserSignUp();
        
        $user = $this->newUser;
        $user['email'] = 'test@unknown.com';

        $response = $this->json('POST', 'api/auth/login', $user);
        $response
            ->assertStatus(401)
            ->assertJson([
                'message' => "Unauthorized"
            ]);
    }
    /**

    *
     * Test login incorrect password
     *
     * @return void
     */
     
    public function testLoginIncorrectPassword()
    {

        $this->testNewUserSignUp();

        $user = $this->newUser;
        $user['password'] = 'unknown';

        $response = $this->json('POST', 'api/auth/login', $user);

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
        $response = $this->json('POST', 'api/auth/login');

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
        $this->testNewUserSignUp();
        
        $user = $this->newUser;
        $user['remember_me'] = true;

        $response = $this->json('POST', 'api/auth/login', $user);

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
        $this->testNewUserSignUp();
        
        $user = $this->newUser;
        $user['remember_me'] = false;

        $response = $this->json('POST', 'api/auth/login', $user);

        $response
            ->assertStatus(200)
            ->assertJson([
                'access_token' => true,
                'token_type' => 'Bearer',
                "expires_at" => Carbon::now()->addHours(2)
            ]);
    }
    /**
     * Test logout - auth
     *
     * @return void
     */
    public function testLogoutAuthenticated()
    {
        $this->createAuthenticatedUser();

        $response = $this->withHeaders($this->headers)
                        ->get('api/auth/logout');
        $response
            ->assertStatus(200)
            ->assertJson([
                'logged_out' => true,
            ]);
    }

    /**
     * Test logout - no auth
     *
     * @return void
     */
    public function testLogoutUnauthenticated()
    {
        $response = $this->withHeaders($this->headers)
                         ->get('api/auth/logout');

        $response
            ->assertStatus(401);
    }
}
