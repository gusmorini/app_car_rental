<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CarBrand;

class CarBrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['name' => 'volkswagen','image' => 'image.png'],
            ['name' => 'ford','image' => 'image.png'],
            ['name' => 'hyundai','image' => 'image.png']
        ];
        
        foreach($data as $key) {
            CarBrand::create($key);
        }
    }
}
