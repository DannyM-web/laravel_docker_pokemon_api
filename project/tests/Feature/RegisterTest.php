<?php

namespace Tests\Feature;

use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class RegisterTest extends TestCase
{
    use RefreshDatabase;

    public function testRegisterPage()
    {
        $response = $this->get('/register');

        $response->assertStatus(200);
    }

    public function testRegisterPageAction()
    {   
        $this->artisan('db:seed');

        $response = $this->post('/reg', [
            'name' => 'test',
            'email'=>'test@test.it',
            'password' => 'provaprova',
            'password_confirmation' => 'provaprova'
        ]);

        $response->assertRedirect(route('login_form'));
    }   
        
}