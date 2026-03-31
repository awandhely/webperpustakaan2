<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BookCollection extends Model
{
    protected $table = 'book_collections';
    protected $fillable = ['user_id', 'book_id'];
}
