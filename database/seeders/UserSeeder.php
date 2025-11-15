<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (app()->environment('production')) {
            DB::table('users')->insert([
                'name' => 'Stanley Ojadovwa',
                'email' => 'stanley.warri@gmail.com',
                'password' => bcrypt('stan2025yr#$'),
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        } else {
            DB::table('users')->insert([
                'name' => 'Stanley Ojadovwa',
                'email' => 'stanley.warri@gmail.com',
                'password' => bcrypt('password'),
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
