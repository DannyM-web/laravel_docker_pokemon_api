<?php

namespace App\Http\Controllers;

use App\Models\Team;
use App\Models\Type;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class ProfileController extends Controller
{
    public function index($id)
    {
        if (!Auth::user()->hasRoles('admin')) {
            if (!(User::where('id', $id)->exists()) || (Auth::user()->id !== (int)$id)) {

                return redirect()->route('index');
            }
        }

        $types = Type::all();
        $userId = $id;
        $teams = Team::where('user_id', '=', $id)->orderByDesc('created_at')->get();
        Cache::put('teams', $teams, '3000');
        $list = Cache::get('teams');

        if (!Cache::has('teams')) {
            $list = $teams;
        }
        return view('profile2', compact('list', 'types', 'userId'));
    }

    public function filter(Request $request)
    {
        $typesId = $request->types;
        $teams = Team::where('user_id', '=', $request->user_id)->orderByDesc('created_at')->get();
        $teamsId = [];
        foreach ($teams as $team) {
            $teamsId[] = $team->id;
        }
        $query = DB::table('pokemons')
            ->select('pokemons.*', 'teams.name AS team_name')
            ->Join('pokemon_type', 'pokemon_type.pokemon_id', '=', 'pokemons.id')
            ->Join('teams', 'teams.id', '=', 'pokemons.team_id')
            ->whereIn('pokemon_type.type_id', $typesId)
            ->whereIn('pokemons.team_id', $teamsId)
            ->groupBy('pokemons.id')
            ->get();

        $types = Type::whereIn('id', $typesId)->get();
        $userId = $request->user_id;
        return view('filter', compact('query', 'types', 'userId'));
    }

    public function queue()
    {

        $user = Auth::user();

        $message = ' ';

        if ($user) {

            if ($user->status) {
                if ($user->status->name == 'pending') {
                    $message = 'La tua richiesta è in stato di approvazione. I nostri admin stanno esaminando la sua richiesta.';
                } elseif ($user->status->name == 'rejected') {
                    $message = 'La tua richiesta di registrazione è stata rifiutata dai nostri admin. Mi dispiace';
                }
                return view('queue', compact('message'));
            }
        }
        return redirect()->route('index');
    }
}
