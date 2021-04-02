<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Blocks;

class BlocksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $blocks = [
            [
                'department_id' => 1,
                'name' => 'A',
                'info' => 'A',
            ],
            [
                'department_id' => 1,
                'name' => 'B',
                'info' => 'B',
            ],
            [
                'department_id' => 1,
                'name' => 'C',
                'info' => 'C',
            ],
            [
                'department_id' => 2,
                'name' => 'B',
                'info' => 'B',
            ],
            [
                'department_id' => 2,
                'name' => 'C',
                'info' => 'C',
            ],
        ];

        try {
            foreach ($blocks as $block) {
                Blocks::create($block);
            }
        } catch (\Throwable $th) {

        }
    }
}
