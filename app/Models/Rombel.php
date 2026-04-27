<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rombel extends Model
{
    protected $fillable = ['name', 'rayon_id'];

    public function rayon()
    {
        return $this->belongsTo(Rayon::class);
    }

    public function students()
    {
        return $this->hasMany(Student::class);
    }
}

