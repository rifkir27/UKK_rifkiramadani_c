<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rayon extends Model
{
    protected $fillable = ['name'];

    public function rombels()
    {
        return $this->hasMany(Rombel::class);
    }

    public function students()
    {
        return $this->hasMany(Student::class);
    }
}

