<?php

namespace Database\Seeders;

use App\Models\Employee;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $user = User::create([
            'user_type' => User::ADMIN,
            'email' => 'admin@superuser.com',
            'password' => Hash::make("123"),
        ]);
        Employee::create([
            'first_name' => 'John',
            'last_name' => 'Doe',
            'position_id' => 1,
            'department_id' => 1,
            'user_id' => $user->id,
        ]);
    }
}
