<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ColorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dataSeeders = [
            [
                'name' => 'Black', 
            ],
            [
                'name' => 'White', 
            ],
            [
                'name' => 'Pink', 
            ],
            [
                'name' => 'Red', 
            ],
            [
                'name' => 'Blue', 
            ],
            
        ];
        DB::table('colors')->insert($dataSeeders);
    }
}
