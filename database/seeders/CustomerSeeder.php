<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        $customers = [
            [
                'name' => 'Ahmed Hassan',
                'email' => 'ahmed@example.com',
                'password' => bcrypt('password123'),
            ],
            [
                'name' => 'Sarah Mohamed',
                'email' => 'sarah@example.com',
                'password' => bcrypt('password123'),
            ],
            [
                'name' => 'Omar Ali',
                'email' => 'omar@example.com',
                'password' => bcrypt('password123'),
            ],
            [
                'name' => 'Fatima Ahmed',
                'email' => 'fatima@example.com',
                'password' => bcrypt('password123'),
            ],
            [
                'name' => 'Youssef Ibrahim',
                'email' => 'youssef@example.com',
                'password' => bcrypt('password123'),
            ],
            [
                'name' => 'Layla Omar',
                'email' => 'layla@example.com',
                'password' => bcrypt('password123'),
            ],
            [
                'name' => 'Mohamed Rashid',
                'email' => 'rashid@example.com',
                'password' => bcrypt('password123'),
            ],
            [
                'name' => 'Noor Hassan',
                'email' => 'noor@example.com',
                'password' => bcrypt('password123'),
            ],
            [
                'name' => 'Ali Khaled',
                'email' => 'ali@example.com',
                'password' => bcrypt('password123'),
            ],
            [
                'name' => 'Hana Youssef',
                'email' => 'hana@example.com',
                'password' => bcrypt('password123'),
            ],
        ];

        foreach ($customers as $customer) {
            User::create($customer);
        }
    }
}