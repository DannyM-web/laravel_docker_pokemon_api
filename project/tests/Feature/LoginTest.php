<?php

namespace Tests\Feature;

use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    public function testLoginPage()
    {
        $response = $this->get('/login');

        $response->assertStatus(200);
    }

    public function testLoginTrainerAction()
    {   
        $user = User::factory()->create([
            'name'=>'test',
        ]);
        $response = $this->post('/auth', [
            'name'=>'test',
            'password'=>'password'
        ]);
        $response->assertRedirect('/');
        // $response->assertSessionMissing('errors');

    }

    public function testLoginAdminAction()
    {
        $user= User::factory()->create([
            'name'=>'testadmin'
        ]);
        $role= Role::factory()->create();
        $user->roles()->attach($role);

        // dd($user->roles);

        $response = $this->post('/auth', [
            'name'=>'testadmin',
            'password'=>'password'
        ]);

       
        $response->assertRedirect('/admin');
    }

    public function testLoginFailedAction()
    {
        $response = $this->post('/auth',[
            'name'=>'danilo',
            'password'=>'provaprova'
        ])->assertRedirect(route('login_form'));
    }

    
}