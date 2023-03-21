<?php

namespace Database\Seeders;

use App\Models\Position;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PositionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Position::create([
            'name' => 'Administrative Officer',
            'is_deletable' => false
        ]);

        Position::create([
            'name' => 'Finance Department',
            'is_deletable' => false
        ]);

        Position::create([
            'name' => 'Executive AO/ Complex Manager',
            'is_deletable' => false
        ]);

        Position::create([
            'name' => 'Security Officer',
            'is_deletable' => false
        ]);
        
        Position::create([
            'name' => 'Administrator',
        ]);
    }
}
