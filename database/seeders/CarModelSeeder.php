<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CarModel;

class CarModelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'car_brand_id' => '1',
                'name' => 'gol 1.0',
                'image' => 'image.png',
                'number_doors' => '2',
                'places' => '5',
                'air_bag' => '0',
                'abs' => '0'
            ],
            [
                'car_brand_id' => '2',
                'name' => 'ford ka sedan',
                'image' => 'image.png',
                'number_doors' => '4',
                'places' => '5',
                'air_bag' => '1',
                'abs' => '1'
            ],
            [
                'car_brand_id' => '3',
                'name' => 'hb20s 1.6',
                'image' => 'image.png',
                'number_doors' => '4',
                'places' => '5',
                'air_bag' => '1',
                'abs' => '1'
            ],
        ];
        
        foreach($data as $key) {
            CarModel::create($key);
        }        
    }
}
