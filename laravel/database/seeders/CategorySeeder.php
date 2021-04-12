<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categorys = [
            [
                'name' => 'A',
                'info' => 'A',
            ],
            [
                'name' => 'B',
                'info' => 'B',
            ],
            [
                'name' => 'C',
                'info' => 'C',
            ],
        ];

        try {
            foreach ($categorys as $category) {
                Category::create($category);
            }
        } catch (\Throwable $th) {
        }
    }
}
