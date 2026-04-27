<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        'transaction_code',
        'student_id',
        'officer_id',
        'borrow_date',
        'due_date',
        'return_date',
        'status',
        'notes',
    ];

    protected $casts = [
        'borrow_date' => 'date',
        'due_date' => 'date',
        'return_date' => 'date',
    ];

    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }

    public function officer()
    {
        return $this->belongsTo(User::class, 'officer_id');
    }

    public function details()
    {
        return $this->hasMany(TransactionDetail::class);
    }

    public function fines()
    {
        return $this->hasMany(Fine::class);
    }
}

