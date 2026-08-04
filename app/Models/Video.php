<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    protected $fillable = [
        'title', 'thumbnail', 'video_url', 'duration', 'views', 'published_at',
    ];

    protected $casts = [
        'views' => 'integer',
        'published_at' => 'date',
    ];
}
