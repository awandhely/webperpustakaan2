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
        'category_id',
        'description'
    ];

    public function category()
{
    return $this->belongsTo(\App\Models\Category::class);
}

    public function ratings()
    {
        return $this->hasMany(BookRating::class);
    }

    public function collectedBy()
    {
        return $this->belongsToMany(User::class, 'book_collections');
    }
}
