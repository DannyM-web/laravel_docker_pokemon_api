<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Ability;
use App\Models\Pokemon;
use App\Models\Team;
use App\Models\Type;
use App\Services\Caller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class TeamController extends Controller
{
    public function create()
    {
        return view('teamCreate');
    }

    public function store(Request $request, Response $response)
    {
        // $request->headers->set('Content-Type','application/json');
        $user = Auth::user();

        $validatedData = $request->validate([
            'name' => 'required|max:255',
        ]);
        $team = new Team;
        $team->name = $validatedData['name'];
        $team->user_id = 2;
        $team->save();

        return redirect()->route('index');
    }

    public function index()
    {
        $teams = Team::all();
        return view('index', compact('teams'));
    }

    public function show($id)
    {
        $team = Team::findOrFail($id);

        return view('showTeam', compact('team'));
    }

    function catch (Request $request, Caller $caller) {
        $team = Team::findOrFail($request['team_id']);

        $response = $caller->call(rand(1, 500))->json();
        $id = $response['id'];
        $name = $response['name'];
        $types = $response['types'];
        $baseExp = $response['base_experience'];
        $picture = $response['sprites']['back_default'];

        $pokemon = new Pokemon;
        $pokemon->name = $name;
        $pokemon->base_exp = $baseExp;
        $pokemon->picture = $picture;
        $pokemon->team_id = $team->id;
        $pokemon->save();

        foreach ($response['abilities'] as $x_ability) {

            if (Ability::where('name', $x_ability['ability']['name'])->count() > 0) {
                $ability = Ability::where('name', $x_ability['ability']['name'])->get();

            } else {
                $ability = new Ability;
                $ability->name = $x_ability['ability']['name'];
                $ability->description = Str::random(40);
                $ability->save();
            }
            $pokemon->abilities()->attach($ability);
        }

        foreach ($response['types'] as $x_type) {

            if (Type::where('name', $x_type['type']['name'])->count() > 0) {
                $type = Type::where('name', $x_type['type']['name'])->get();

            } else {
                $type = new Type();
                $type->name = $x_type['type']['name'];
                $type->save();
            }
            $pokemon->types()->attach($type);
        }
        return redirect()->route('index');
    }
}
