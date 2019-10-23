<?php

use App\Role;
use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        User::create([
            'role_id' => 1,
            'name' => 'System Administrator',
            'username' => 'admin',
            'email' => 'systemadmin@example.test',
            'is_active' => 1,
            'password' => Hash::make('password')
        ]);
        
    }
}
