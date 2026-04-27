<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = [
        'category_id',
        'code',
        'isbn',
        'title',
        'author',
        'publisher',
        'year',
        'stock',
        'price',
        'cover_image',
        'description',
        'status',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function transactionDetails()
    {
        return $this->hasMany(TransactionDetail::class);
    }
}

