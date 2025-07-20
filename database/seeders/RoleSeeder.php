<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    public function run()
    {
        Role::create(['name' => 'super_admin']);
        Role::create(['name' => 'doctor']);
        Role::create(['name' => 'patient']);
        Role::create(['name' => 'Receptionist']);
        Role::create(['name' => 'MD-trustee']);
        Role::create(['name' => 'guest']);

        // Add other roles as needed
    }
}
