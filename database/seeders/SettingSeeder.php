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
            // [
            //     'key' => 'monthly.due',
            //     'value' => "0",
            // ],
            // [
            //     'key' => 'electricity.fee',
            //     'value' => "0",
            // ],
            // [
            //     'key' => 'water.fee',
            //     'value' => "0",
            // ],
            // [
            //     'key' => 'penalty.fee.percentage',
            //     'value' => "0",
            // ],
            [
                'key' => 'administrative.officer',
                'value' => "admin1@superuser.com",
            ],

            [
                'key' => 'finance.department',
                'value' => "admin2@superuser.com"
            ],

            [
                'key' => 'executive.ao.complex.manager',
                'value' => "admin3@superuser.com"
            ],

            [
                'key' => 'security.officer',
                'value' => "admin4@superuser.com"
            ],

            [
                'key' => 'property.engineer',
                'value' => "admin5@superuser.com"
            ],

            
        ];

        foreach ($settings as $setting) {
            Setting::create($setting);
        }
    }
}
