<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = [
            [
                'key' => 'monthly.due',
                'value' => "0",
            ],
            [
                'key' => 'electricity.fee',
                'value' => "0",
            ],
            [
                'key' => 'water.fee',
                'value' => "0",
            ],
            
        ];

        foreach ($settings as $setting) {
            Setting::create($setting);
        }
    }
}
