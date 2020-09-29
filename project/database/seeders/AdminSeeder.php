<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'admin',
            'email' => 'admin@admin.it',
            'password' => Hash::make('admin')
        ]);

        $user = User::where('name', 'admin')->get()->first();
        $user->assignRole('admin');
        $user->assignStatus('accepted');
    }
}
