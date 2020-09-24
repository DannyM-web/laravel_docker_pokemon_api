<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
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
            'password' => 'required|string|min:8|confirmed',
            'password_confirmation' => 'required'
        ]);
        
        if(User::where('name',$validatedData['name'])->first() ){
            return Redirect::back()->withErrors(['Nome Già esistente, prova un altro']);
        }
        
        $user = User::create([
            'name' => $validatedData['name'],
            'password' => Hash::make($validatedData['password'])
        ]);
        

        return redirect()->route('login_form')->with('message', 'Registrazione avvenuta con successo, inserisci i tuoi dati per effettuare il login');

    }
}
