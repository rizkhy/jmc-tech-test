<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'province_code', 'code'];

    public function province()
    {
        return $this->belongsTo(Province::class, 'province_code', 'code');
    }

    public function residents()
    {
        return $this->hasMany(Resident::class);
    }
}
