<?php

namespace App\Http\Controllers;

use App\Models\Pending;
use App\Models\Status;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function adminPanel()
    {

        $users = User::all();

        return view('admin.admin', compact('users'));
    }

    public function deleteCoach($id)
    {
        $user = User::findOrFail($id);

        $user->delete();

        return redirect()->back();
    }

    public function editCoachView($id)
    {
        $user = User::findOrFail($id);

        return view('admin.editCoach', compact('user'));
    }

    public function updateCoach(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $validatedData = $request->validate([
            'name' => 'required|string|alpha_dash|max:20'
        ]);

        $user->name = $validatedData['name'];
        $user->save();

        return redirect()->route('admin');
    }

    public function createCoach(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|alpha_dash|max:20',
            'password' => 'required|string|min:8|confirmed',
            'password_confirmation' => 'required',
            'role' => 'required|exists:roles,name'
        ]);

        if (User::where('name', $validatedData['name'])->first()) {
            return redirect()->back()->withErrors(['Nome Già esistente!']);
        }

        $user = User::create([
            'name' => $validatedData['name'],
            'password' => Hash::make($validatedData['password'])
        ]);

        $user->assignRole($validatedData['role']);

        return redirect()->back()->with('message', 'Utente creato!');
    }

    public function getRequests()
    {
        $pendings = Pending::all();
        return view('admin.request', compact('pendings'));
    }

    public function acceptPending($id)
    {
        $user = User::findOrFail($id);
        $pending = Pending::where('user_id', $id)->get()->first();
        $user->assignStatus('accepted');
        $user->save();

        $accepted = Status::where('name', 'accepted')->get()->first();
        $pending->status()->associate($accepted);
        $pending->save();
        return redirect()->back();
    }

    public function rejectPending($id)
    {
        $user = User::findOrFail($id);
        $pending = Pending::where('user_id', $id)->get()->first();
        $user->assignStatus('rejected');
        $user->save();

        $rejected = Status::where('name', 'rejected')->get()->first();
        $pending->status()->associate($rejected);
        $pending->save();
        return redirect()->back();
    }
}
