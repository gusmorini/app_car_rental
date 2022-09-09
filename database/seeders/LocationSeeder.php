<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Location;

class LocationSeeder extends Seeder
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
                'client_id' => '1',
                'car_id' => '1',
                'start_date' => '2022-09-08',
                'expected_end_date' => '2022-09-10',
                'final_date_performed' => '2022-09-12',
                'daily_value' => '50.00',
                'starting_km' => '10000',
                'final_km' => '12000',
            ],
            [
                'client_id' => '1',
                'car_id' => '1',
                'start_date' => '2022-09-13',
                'expected_end_date' => '2022-09-15',
                'final_date_performed' => '2022-09-15',
                'daily_value' => '50.00',
                'starting_km' => '12000',
                'final_km' => '14000',
            ],
            [
                'client_id' => '2',
                'car_id' => '2',
                'start_date' => '2022-09-08',
                'expected_end_date' => '2022-09-10',
                'final_date_performed' => '2022-09-12',
                'daily_value' => '80.00',
                'starting_km' => '15000',
                'final_km' => '17000',
            ],
            [
                'client_id' => '3',
                'car_id' => '3',
                'start_date' => '2022-09-08',
                'expected_end_date' => '2022-09-10',
                'final_date_performed' => '2022-09-12',
                'daily_value' => '90.00',
                'starting_km' => '20000',
                'final_km' => '25000',
            ],
            
        ];

        foreach($data as $key) {
            Location::create($key);
        }

    }
}
