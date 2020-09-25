<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\Http;
use App\Services\Caller;
use App\Models\Team;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TeamTest extends TestCase
{
    use RefreshDatabase;
    public function testTeamCreatePageView()
    {   
        $user = User::factory()->create();
        $response = $this->actingAs($user)
        ->get('/team/create');

        $response->assertSuccessful();
        $response->assertViewIs('teamCreate');
    }

    public function testTeamCreateAction()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)
        ->post('/team/store',['name'=>'teamtest']);

        $this->assertAuthenticated($guard = null);

        $response->assertRedirect(route('index'));

    }

    public function testTeamEditPageView()
    {   
        $team = Team::factory()->create();
        $user = User::factory()->create();
        $response = $this->actingAs($user)
        ->get('/team/edit/' . $team->id);
        
        $this->assertAuthenticated($guard = null);
        $response->assertViewIs('teamEdit');
        $response->assertSuccessful();
       
    }
    public function testTeamEditAction()
    {
        $team = Team::factory()->create();
        $user = User::factory()->create();
        $response = $this->actingAs($user)
        ->post('/team/update/' . $team->id,['name'=>'teamtestedited']);

        $this->assertAuthenticated($guard = null);
        $response->assertRedirect('/team/show/'. $team->id);
        $response->assertSessionHasNoErrors();
    }

    // da testare non funziona
    public function testTeamDelete()
    {   
        $user = User::factory()->create();
        $team = Team::factory()->create([
            'user_id'=>$user->id
        ]);
        $response = $this->actingAs($user)->delete('/team/delete/' . $team->id);
        $this->assertEquals($team->where('user_id',$user->id)->first(),null);
            
        $response->assertRedirect('/profile/' . $user->id);
        $response->assertSessionHasNoErrors();
    }

    public function testTeamIndexGuestPage()
    {
        $response = $this->get('/');
        $this->assertGuest($guard = null);
        $response->assertSuccessful();
        $response->assertViewIs('home');
    }

    public function testTeamIndexAuthPage()
    {   
        $user = User::create([
            'name'=>'test',
            'password'=>'testings'
        ]);
        $response = $this->actingAs($user)->get('/');
        $this->assertAuthenticatedAs($user,$guard = null);
        $response->assertSuccessful();
        $response->assertViewIs('home');
    }

    public function testTeamShowPage()
    {
        $user = User::factory()->create();
        $team= Team::factory()->create();
        $response = $this->get('/team/show/'. $team->id);
        $response->assertSuccessful();

    }

    public function testTeamPokemonCath()
    {   
        $team = Team::factory()->create();

        $data = [
            'id'=>'1',
            'name'=>'test',
            'base_experience'=>'100',
            'types'=>[
                [
                'type'=>[
                    'name'=>'type1'
                ],
              ],
            ],
            'abilities'=>[
                [
                    'ability'=>[
                        'name'=>'ability1'
                    ],
                ],
                
            ],
            'sprites'=>['front_default'=>'img1']
        ];
        Http::fake([
            'https://pokeapi.co/api/v2/pokemon/*'=> Http::response($data, 200, ['Headers'])
        ]);

        // $caller = new Caller('https://pokeapi.co/api/v2/pokemon/');

        // $response = $caller->call(1);
        $response = $this->get(route('catch', ['team_id'=>$team->id]));
        // dd($response);
        $response->assertRedirect($uri = null);  
    }
    
}