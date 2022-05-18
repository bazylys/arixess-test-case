<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class ManagerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::query()->create([
            'name' => 'Manager',
            'email' => 'manager@arixess',
            'password' => 'Arixess1',
            'role_id' => config('auth.user_roles.manager'),
        ]);
    }
}
