<?php

namespace Database\Seeders;

use App\Models\LeaveType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LeaveTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $leaveTypes = [
            [
                "name" => "Vacation Leave",
                "description" => "Vacation Leave",
            ],
            [
                "name" => "Sick Leave",
                "description" => "Sick Leave",
            ]
        ];


        foreach ($leaveTypes as $leaveType) {
            LeaveType::create($leaveType);
        }
    }
}
