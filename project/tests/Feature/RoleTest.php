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

        $admin = User::find(1);
        $response = $this->actingAs($admin)->get('/admin');
        foreach (User::all() as $user) {

            $response->assertViewIs('admin.admin');
            $response-> assertSee($user->name); 

        }
    }

    public function testAdminPageViewAsNotAdmin()
    {
        $role = Role::factory()->create([
            'name'=>'trainer'
        ]);
        $trainer = User::factory()->create();
        $trainer->roles()->attach($role);

        $response = $this->actingAs($trainer)->get('/admin');

        $response->assertRedirect(route('index'));
    }
}