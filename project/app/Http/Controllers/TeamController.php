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
            'name' => 'required|alpha_dash|max:255',
        ]);
        $team = new Team;
        $team->name = $validatedData['name'];
        $team->user_id = $user -> id;
        $team->save();

        return redirect()->route('index');
    }

    public function edit($id)
    {   
        $team = Team::findOrFail($id);

        return view ('teamEdit', compact('team'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|alpha_dash|max:255',
        ]);

        $team = Team::findOrFail($id);
        $team ->name = $validatedData['name'];
        $team->save();

        return redirect()->route('show', $team->id)->with('message','Nome del team modificato con successo');
    }

    public function delete($id)
    {
        $team = Team::findOrFail($id);
        $userId = $team->user_id;
        $teamName = $team->name;
        $team ->delete();

        return redirect()->route('profile',$userId)->with('message','Team '. $teamName . ' rimosso con successo');
    }

    public function index()
    {
        $teams = Team::all();
        return view('home', compact('teams'));
    }

    public function show($id)
    {
        $team = Team::findOrFail($id);
        $userId = Auth::id();

        return view('showTeam', compact('team','userId'));
    }

    function catch (Request $request, Caller $caller) {
        $team = Team::findOrFail($request['team_id']);

        if(($team->pokemons->count()) >= 3){
            return redirect()->back()->with('message','Hai già abbastanza pokemon nel tuo team!');
        }
        $response = $caller->call(rand(1, 500))->json();
        $id = $response['id'];
        $name = $response['name'];
        $types = $response['types'];
        $baseExp = $response['base_experience'];
        $picture = $response['sprites']['front_default'];
        
        $pokemon = new Pokemon;
        $pokemon->name = $name;
        $pokemon->base_exp = $baseExp;
        $pokemon->picture = $picture;
        $pokemon->team_id = $team->id;
        // var_dump($response['abilities']);
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
        return redirect()->back()->with('message','Un nuovo pokemon è stato aggiunto al tuo team!');
    }
}
