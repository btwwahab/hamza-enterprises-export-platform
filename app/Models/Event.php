<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [
        'code', 'title', 'category', 'event_date', 'author', 'shares_count', 'image', 'summary', 'content',
    ];

    protected $casts = [
        'event_date' => 'date:Y-m-d',
        'shares_count' => 'integer',
    ];

    public static function nextCode(): string
    {
        $last = static::query()
            ->where('code', 'like', 'EVENT-%')
            ->orderByRaw('CAST(SUBSTRING(code, 7) AS UNSIGNED) DESC')
            ->value('code');

        $next = $last ? ((int) substr($last, 6)) + 1 : 1;

        return 'EVENT-' . str_pad((string) $next, 3, '0', STR_PAD_LEFT);
    }
}
