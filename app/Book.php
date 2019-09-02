<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = [
        'title', 'author', 'price',
    ];

    public function transaction(){
        return $this->belongsToMany('App\Transaction');
    }
}
