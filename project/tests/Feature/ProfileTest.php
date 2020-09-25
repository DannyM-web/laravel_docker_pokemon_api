<?php

namespace Tests\Feature;

use App\Models\Team;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProfileTest extends TestCase
{
    use RefreshDatabase;

    public function testProfilePageView()
    {
        $user = User::factory()->create();
        $team = Team::factory()->create([
            'user_id'=>$user->id
        ]);
        $response = $this->actingAs($user)->get('/profile/' . $user->id);
        $this->assertEquals($user->id, $team->user->id);
        $response->assertSuccessful();
        $response->assertViewIs('profile2');
    }
}