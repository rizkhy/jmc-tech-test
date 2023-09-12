<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'code'];

    public function cities()
    {
        return $this->hasMany(City::class, 'province_code', 'code');
    }

    public function residents()
    {
        return $this->hasMany(Resident::class);
    }
}
