<?php

namespace Tests\Feature\User;

use App\Http\Middleware\VerifyCsrfToken;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;


class Login extends TestCase
{
    /**
     * @test
     */
    public function successLogin(){

        $this->withoutMiddleware(VerifyCsrfToken::class);
        $user = [
            'user_name'=>'admin',
            'password'=>'123456'
        ];
        $this->post(route('login'),$user);
        $this->assertTrue(Auth::check());
        $response = $this->get(route('home'));
        $response->assertStatus(200);
    }

    /**
     * @test
     */
    public function failLogin(){
        $this->withoutMiddleware(VerifyCsrfToken::class);
        $user = [
            'user_name'=>'admin',
            'password'=>'1234567'
        ];
        $response = $this->post(route('login'),$user);
        $this->assertFalse(Auth::check());
        $response->assertSessionHasErrors(['user_name'=>'These credentials do not match our records.']);
    }

    /**
     * @test
     */
    public function emptyPasswordShowErrorMessage(){
        $this->withoutMiddleware(VerifyCsrfToken::class);
        $user = [
            'user_name'=>'admin',
            'password'=>''
        ];
        $response = $this->post(route('login'),$user);
        $response->assertSessionHasErrors(['password'=>"The password field is required."]);
    }

    /**
     * @test
     */
    public function emptyUserNameShowErrorMessage(){
        $this->withoutMiddleware(VerifyCsrfToken::class);
        $user = [
            'user_name'=>'',
            'password'=>'123456'
        ];
        $response = $this->post(route('login'),$user);
        $response->assertSessionHasErrors(['user_name'=>"The user name field is required."]);
    }

    /**
     * @test
     */
    public function emptyUserNameAndPasswordShowErrorMessage(){
        $this->withoutMiddleware(VerifyCsrfToken::class);
        $user = [
            'user_name'=>'',
            'password'=>''
        ];
        $response = $this->post(route('login'),$user);
        $response->assertSessionHasErrors([
            'user_name'=>"The user name field is required.",
            'password'=>"The password field is required."
        ]);
    }
}
