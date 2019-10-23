<?php

use App\Rank;
use App\Role;
use Illuminate\Database\Seeder;

class RanksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Rank::create([
            'name' => 'English Studies'
        ]);
        Rank::create([
            'name' => 'Literatures'
        ]);
        Rank::create([
            'name' => 'Philosophy'
        ]);
        Rank::create([
            'name' => 'Economics'
        ]);
        Rank::create([
            'name' => 'Foreign Language'
        ]);
        Rank::create([
            'name' => 'Political Science'
        ]);
        Rank::create([
            'name' => 'Sociology'
        ]);
        Rank::create([
            'name' => 'History'
        ]);
        Rank::create([
            'name' => 'Communication & Media Studies'
        ]);
        Rank::create([
            'name' => 'Interdisciplinary'
        ]);

        $role1 = Role::create([
            'rolename' => 'Administrator',
        ]);
        $role2 = Role::create([
            'rolename' => 'Dean',
        ]);
        $role3 = Role::create([
            'rolename' => 'Department Head',
        ]);
        $role4 = Role::create([
            'rolename' => 'Faculty Member',
        ]);
    }
}
