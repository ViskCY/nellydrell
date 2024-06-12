<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            ['id' => 1, 'name' => 'Portreed', 'description' => 'saddsadasda', 'background_image' => NULL],
            ['id' => 2, 'name' => 'Figuraalmaalid', 'description' => 'asdasdasfdsaasfds', 'background_image' => NULL],
            ['id' => 3, 'name' => 'Loodusmaalid', 'description' => 'saasdfsdfsdfsdfsdffsd', 'background_image' => NULL],
            ['id' => 4, 'name' => 'Linna vaated', 'description' => 'sdafsdfggfdgdfgdfgd', 'background_image' => NULL],
            ['id' => 5, 'name' => 'Abstraktmaalid', 'description' => 'sadfgdssdgvcgfhhdfgghfhgf', 'background_image' => NULL],
        ];

        foreach ($categories as $category) {
            DB::table('categories')->insert([
                'id' => $category['id'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'name' => $category['name'],
                'description' => $category['description'],
                'background_image' => $category['background_image'],
            ]);
        }
    }
}
