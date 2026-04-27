<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = [
        'user_id',
        'nis',
        'rayon_id',
        'rombel_id',
        'address',
        'barcode',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function rayon()
    {
        return $this->belongsTo(Rayon::class);
    }

    public function rombel()
    {
        return $this->belongsTo(Rombel::class);
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class, 'student_id');
    }
}

