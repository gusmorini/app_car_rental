<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarBrand extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'image'];

    public function rules() {
        return [
            'name' => 'required|unique:car_brands,name,'.$this->id.'|min:3',
            'image' => 'required|file|mimes:png'
        ];
    }

    public function feedback() {
        return [
            'required' => 'the :attribute field is required',
            'name.unique' => 'the brand name already exists',
            'name.min' => 'the :attribute field must contain at least :min characters',
            'image.file' => 'the attribute must be of type file',
            'image.mimes' => 'the file must be of type png'
        ];
    }
}
