<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 存在しない場合のみユーザーを挿入
        if (!DB::table('users')->where('email', 'test@example.com')->exists()) {
            DB::table('users')->insert([
                'name' => 'test',
                'email' => 'test@example.com',
                'password' => Hash::make('password'),
            ]);
        }
    }
}
