<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarModel extends Model
{
    use HasFactory;
    protected $fillable = ['car_brand_id', 'name', 'image', 'number_doors', 'places', 'air_bag', 'abs'];

    public function rules() {
        return [
            'car_brand_id' => 'exists:car_brands,id',
            'name' => 'required|unique:car_models,name,'.$this->id.'|min:3',
            'image' => 'required|file|mimes:png,jpeg,jpg',
            'number_doors' => 'required|integer|digits_between:1,5',
            'places' => 'required|integer|digits_between:1,20',
            'air_bag' => 'required|boolean',
            'abs' => 'required|boolean'
        ];
    }
}