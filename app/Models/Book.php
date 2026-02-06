<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = [
        'title',
        'author',
        'publisher',
        'year',
        'stock',
        'image', // 🔥 wajib
        'category_id'
    ];

    public function category()
{
    return $this->belongsTo(\App\Models\Category::class);
}

}
