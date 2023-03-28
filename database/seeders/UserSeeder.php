<?php

namespace Database\Seeders;

use App\Models\Employee;
use App\Models\Position;
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
            'position_id' => 5,
            'department_id' => 1,
            'user_id' => $user->id,
        ]);


        $user = User::create([
            'user_type' => User::ADMIN,
            'email' => 'admin1@superuser.com',
            'password' => Hash::make("123"),
        ]);

        Employee::create([
            'first_name' => 'Administrative',
            'last_name' => 'Officer',
            'position_id' => Position::ADMINISTRATIVE_OFFICER,
            'department_id' => 1,
            'user_id' => $user->id,
        ]);

        $user = User::create([
            'user_type' => User::ADMIN,
            'email' => 'admin2@superuser.com',
            'password' => Hash::make("123"),
        ]);

        Employee::create([
            'first_name' => 'Finance',
            'last_name' => 'Department',
            'position_id' => Position::FINANCE_DEPARTMENT,
            'department_id' => 1,
            'user_id' => $user->id,
        ]);

        $user = User::create([
            'user_type' => User::ADMIN,
            'email' => 'admin3@superuser.com',
            'password' => Hash::make("123"),
        ]);

        Employee::create([
            'first_name' => 'Executive',
            'last_name' => 'Complex Manager',
            'position_id' => Position::EXECUTIVE_AO_COMPLEX_MANAGER,
            'department_id' => 1,
            'user_id' => $user->id,
        ]);

        $user = User::create([
            'user_type' => User::ADMIN,
            'email' => 'admin4@superuser.com',
            'password' => Hash::make("123"),
        ]);

        Employee::create([
            'first_name' => 'Security',
            'last_name' => 'Officer',
            'position_id' => Position::SECURITY_OFFICER,
            'department_id' => 1,
            'user_id' => $user->id,
        ]);

        $user = User::create([
            'user_type' => User::ADMIN,
            'email' => 'admin5@superuser.com',
            'password' => Hash::make("123"),
        ]);

        Employee::create([
            'first_name' => 'Property',
            'last_name' => 'Engineer',
            'position_id' => Position::PROPERTY_ENGINEER,
            'department_id' => 1,
            'user_id' => $user->id,
        ]);

    }
}
