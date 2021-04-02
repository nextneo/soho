<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Departments;

class DepartmentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $departments = [
            [
                'name' => 'Soho',
                'total_floor' => 25,
                'total_block' => 3,
            ],
            [
                'name' => 'Esto',
                'total_floor' => 25,
                'total_block' => 2,
            ],
            [
                'name' => 'Alto',
                'total_floor' => 25,
                'total_block' => 2,
            ],
        ];

        try {
            foreach ($departments as $department) {
                Departments::create($department);
            }
        } catch (\Throwable $th) {

        }
    }
}
