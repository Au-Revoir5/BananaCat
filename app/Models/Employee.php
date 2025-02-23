<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = ['name', 'age', 'address', 'phone'];

    public static function rules()
    {
        return [
            'name' => 'required|string|min:5|max:20',
            'age' => 'required|integer|min:21',
            'address' => 'required|string|min:10|max:40',
            'phone' => 'required|string|regex:/^08[0-9]{7,10}$/',
        ];
    }
}
