<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use DateTime;

class MealsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('meals')->insert(
            [   'user_id' => 1,
                'day_of_week'=>'sample',
                'meal_time'=>'sample',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
            ]
        );
    }
}
