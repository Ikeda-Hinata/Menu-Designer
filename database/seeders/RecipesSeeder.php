<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use DateTime;

class RecipesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $imagePath = 'images/チャーハン.jpg';
        
        DB::table('recipes')->insert(
            [   'user_id' => 1,
                'image' => $imagePath,
                'title' => 'チャーハン',
                'description'=> 'test',
                'ingredients' => '肉',
                'instruction' => '油をひく',
                'date' => now(),
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
        ]);
    }
}
