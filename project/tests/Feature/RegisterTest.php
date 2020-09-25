<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
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
        $response = $this->post('/reg', [
            'name' => 'alfio',
            'password' => 'provaprova',
            'password_confirmation' => 'provaprova'
        ]);

        $response->assertRedirect(route('login_form'));
    }   
        
}