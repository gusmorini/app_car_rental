<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Car;

class CarSeeder extends Seeder
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
                'car_model_id' => '1',
                'board' => 'JWE-2021',
                'available' => '1',
                'km' => '10000'
            ],
            [
                'car_model_id' => '2',
                'board' => 'AMW-2021',
                'available' => '1',
                'km' => '15000'
            ],
            [
                'car_model_id' => '3',
                'board' => 'HLT-2021',
                'available' => '1',
                'km' => '20000'
            ],
        ];

        foreach($data as $key) {
            Car::create($key);
        }
    }
}
