<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Apartments;

class ApartmentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        try {
            for($i = 0; $i<=24; $i++){
                for($j = 1; $j<=11; $j++){
                    $code = 'A' . str_pad($i, 2, '0', STR_PAD_LEFT) . str_pad($j, 2, '0', STR_PAD_LEFT);
                    Apartments::create([
                        'block_id' => 1,
                        // 'user_id' => 1,
                        'code' => $code ,
                        'floor' => $i,
                        'status' => 'Available'
                    ]);
                }
            }

            for($i = 0; $i<=24; $i++){
                for($j = 1; $j<=11; $j++){
                    $code = 'B' . str_pad($i, 2, '0', STR_PAD_LEFT) . str_pad($j, 2, '0', STR_PAD_LEFT);
                    Apartments::create([
                        'block_id' => 2,
                        // 'user_id' => 1,
                        'code' => $code ,
                        'floor' => $i,
                        'status' => 'Available'
                    ]);
                }
            }

            for($i = 0; $i<=24; $i++){
                for($j = 1; $j<=11; $j++){
                    $code = 'C' . str_pad($i, 2, '0', STR_PAD_LEFT) . str_pad($j, 2, '0', STR_PAD_LEFT);
                    Apartments::create([
                        'block_id' => 3,
                        // 'user_id' => 1,
                        'code' => $code ,
                        'floor' => $i,
                        'status' => 'Available'
                    ]);
                }
            }
        } catch (\Throwable $th) {
            dd($th);
        }
    }
}
