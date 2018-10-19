<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

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

    // public function testExistingUserSignUp()
    // {
    // 	$response = $this->json('POST', 'api/auth/signup', [
		  //  "name" => "Kye Buffery",
		  //  "email" => "kye@user.com",
		  //  "password" => "password",
		  //  "password_confirmation" => "password"
    // 	]);

    //     $response
    //         ->assertStatus(201)
    //         ->assertJson([
    //             'created' => true,
    //         ]);
    // }
}
