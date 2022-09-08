<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;
    
    protected $fillable = ['car_model_id', 'board', 'available', 'km'];

    public function rules() {
        return [
            'car_model_id' => 'exists:car_models,id',
            'board' => 'required|unique:cars',
            'available' => 'required|boolean',
            'km' => 'required|integer'
        ];
    }

    public function carModel() {
        return $this->belongsTo('App\Models\CarModel');
    }

    public function location() {
        return $this->hasMany('App\Models\Location');
    }

}
