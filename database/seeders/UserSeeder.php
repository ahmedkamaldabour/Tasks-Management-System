<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        \App\Models\User::create([
            'name' => [
                'en' => 'Admin',
                'ar' => 'مدير',
            ],
            'email' => 'admin@admin.com',
            'password' => bcrypt('123456'),
            'role' => 'admin',
        ]);
        \App\Models\User::factory()->count(10)->create();
    }
}
