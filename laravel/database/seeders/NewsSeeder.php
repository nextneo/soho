<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\News;

class NewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $News = [
            [
                'category_id' => 1,
                'title' => 'title A',
                'header' => 'header A',
                'body' => 'body A',
                'footer' => 'footer A',
            ],
            [
                'category_id' => 2,
                'title' => 'title B',
                'header' => 'header B',
                'body' => 'body B',
                'footer' => 'footer B',
            ],
            [
                'category_id' => 3,
                'title' => 'title C',
                'header' => 'header C',
                'body' => 'body C',
                'footer' => 'footer C',
            ],
        ];

        try {
            foreach ($News as $New) {
                News::create($New);
            }
        } catch (\Throwable $th) {

        }
    }
}
