<?php

namespace Tests\Feature;

use App\Models\Pending;
use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminTest extends TestCase
{
    use RefreshDatabase;

    public function testDeleteCoach()
    {   

        $this->artisan('db:seed');
        $user = User::factory()->create();
        $admin = User::factory()->create();
        $admin->assignRole('admin');

        $response = $this->actingAs($admin)->get(route('deleteCoach',$user->id));

        $response->assertRedirect($uri=null);
    }

    public function testEditCoachView()
    {   
        $this->artisan('db:seed');
        $user = User::factory()->create();
        $admin = User::factory()->create();
        $admin->assignRole('admin');
        

        $response = $this->actingAs($admin)->get(route('editCoach',$user->id));

        // dd($response);
        $response->assertViewIs('admin.editCoach')->assertSee($user->name);
    }

    public function testUpdateCoachAction()
    {   
        $this->artisan('db:seed');
        $admin = User::factory()->create();
        $admin->assignRole('admin');
        
        $user = User::factory()->create();
        $response = $this->actingAs($admin)->post(route('updateCoach',$user->id),[
            'name'=>'testEdited'
        ]);

        $response->assertRedirect(route('admin'));
    }

    public function testCreateNewCoach()
    {
        $response = $this->post(route('createCoach',[
            'name'=>'adminTest',
            'password'=>'test0test',
            'password_confirmation'=>'test0test',
            'role'=>'trainer'
        ]));

        $response->assertRedirect($uri=null);
    }

    public function testRequestsPageView()
    {   
        $this->artisan('db:seed');
        $admin = User::factory()->create();
        $admin->assignRole('admin');
        $response = $this->actingAs($admin)->get(route('requests'));
        
        $response->assertViewIs('admin.request');
    }

    public function testAcceptPendings()
    {   
        $this->artisan('db:seed');
        $user = User::factory()->create();
        $admin = User::factory()->create();
        $pending = Pending::factory()->create();

        $admin->assignRole('admin');
        $response = $this->actingAs($admin)->get(route('acceptPending',$user->id));
        $response->assertRedirect($uri=null);
    }

    public function testRejectPendings()
    {   
        $this->artisan('db:seed');
        $user = User::factory()->create();
        $admin = User::factory()->create();
        $pending = Pending::factory()->create();

        $admin->assignRole('admin');
        $response = $this->actingAs($admin)->get(route('acceptPending',$user->id));
        $response->assertRedirect($uri=null);
    }
}