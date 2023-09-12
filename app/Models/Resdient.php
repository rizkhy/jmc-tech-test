<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resdient extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'id_number',
        'gender',
        'date_of_birth',
        'address',
        'city_id',
        'province_id',
    ];

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function province()
    {
        return $this->belongsTo(Province::class);
    }
}
