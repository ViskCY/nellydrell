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
            ['id' => 1, 'name' => 'Portreed', 'name_en' => 'Portraits'],
            ['id' => 2, 'name' => 'Figuraalmaalid', 'name_en' => 'Figural paintings'],
            ['id' => 3, 'name' => 'Loodusmaalid', 'name_en' => 'Nature paintings'],
            ['id' => 4, 'name' => 'Linna vaated', 'name_en' => 'City views'],
            ['id' => 5, 'name' => 'Abstrakt maalid', 'name_en' => 'Abstract paintings'],
        ];

        foreach ($categories as $category) {
            DB::table('categories')->insert([
                'id' => $category['id'],
                'name' => $category['name'],
                'name_en' => $category['name_en'],
            ]);
        }
    }
}
