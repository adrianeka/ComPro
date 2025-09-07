<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    // Izinkan hanya kolom ini untuk mass assignment
    protected $fillable = [
        'title',
        'slug',
        'thumbnail',
        'excerpt',
        'content',
        'author',
        'published_at',
    ];

    protected $casts = [
        'published_at' => 'datetime',
    ];
}