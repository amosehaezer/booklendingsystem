<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        'user_id', 'borrow_book_date', 'return_book_date', 'status'
    ];
    public function users()
    {
        return $this->belongsTo('App\User');
    }
    public function book()
    {
        return $this->belongsToMany('App\Book');
    }
}
