<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    protected $fillable = ['author', 'location', 'rating', 'text', 'avatar_initial', 'avatar_color'];

    protected $casts = [
        'rating' => 'integer',
    ];
}
