<?php

namespace Database\Seeders;

use App\Models\Account;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $accounts = [
            [
                'code' => '1000',
                'name' => 'Cash In',
                'is_in' => true,
            ],
            [
                'code' => '2000',
                'name' => 'Cash Out',
                'is_in' => false,
            ],
        ];

        foreach ($accounts as $account) {
            Account::create($account);
        }
    }
}
