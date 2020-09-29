<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Pending;
use App\Models\Status;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redirect;

class RegisterController extends Controller
{
    public function register()
    {
        return view('auth.register');
    }

    public function storeUser(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|alpha_dash|max:20',
            'email' => 'required|email|unique:App\Models\User,email',
            'password' => 'required|string|min:8|confirmed',
            'password_confirmation' => 'required'
        ]);

        if (User::where('email', $validatedData['email'])->first()) {
            return Redirect::back()->withErrors(['Email Già esistente, prova un altra']);
        }

        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password'])
        ]);

        $user->assignRole('trainer');
        $user->assignStatus('pending');

        $pending = Pending::create([
            'name' => $user->name,
            'email' => $user->email,
            'user_id' => $user->id,
        ]);

        $status_p = Status::where('name', 'pending')->get()->first();
        $pending->status()->associate($status_p);
        $pending->save();

        return redirect()->route('login_form')->with('message', 'Registrazione avvenuta con successo, attendi di essere accettato da un admin.');
    }
}
