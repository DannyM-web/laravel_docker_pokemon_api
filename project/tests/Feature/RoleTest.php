<?php

namespace Tests\Feature;

use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RoleTest extends TestCase
{
    use RefreshDatabase;

    public function testAdminPageView()
    {   

        $role= Role::factory()->create();
        User::factory(10)->create()->each(function ($user) use ($role)
        {
           $user->roles()->attach($role);
        });


        $response = $this->get('/admin');
        foreach (User::all() as $user) {
            
            $response-> assertSee($user->name); 

        }
    }
}