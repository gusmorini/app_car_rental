<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'car_id',
        'start_date',
        'expected_end_date',
        'final_date_performed',
        'daily_value',
        'starting_km',
        'final_km',
    ];

    public function rules() {
        return [
            'client_id' => 'exists:clients,id',
            'car_id' => 'exists:cars,id',
            'start_date' => 'required',
            'expected_end_date' => 'required|date',
            'final_date_performed' => 'required|date',
            'daily_value' => 'required|numeric',
            'starting_km' => 'required|integer',
            'final_km' => 'required|integer',
        ];
    }

    public function client(){
        return $this->hasOne('App\Models\Client', 'id', 'client_id');
    }

    public function car(){
        return $this->hasOne('App\Models\Car', 'id', 'car_id');
    }
}
