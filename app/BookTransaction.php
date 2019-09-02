<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BookTransaction extends Model
{
    protected $fillable = [
        'book_id', 'transaction_id',
    ];
}
