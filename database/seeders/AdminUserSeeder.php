<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Admin',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
        ]);

        
        User::create([
            'name' => 'User1',
            'password' => Hash::make('user123'), // Mot de passe haché
            'role' => 'user',
        ]);
        User::create([
            'name' => 'User2',
            'password' => Hash::make('user123'), // Mot de passe haché
            'role' => 'user',
        ]);
    
    }
}
