<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    protected $fillable = [
        'code', 'name', 'description', 'maker', 'model', 'year', 'price', 'mileage',
        'fuel', 'transmission', 'body', 'location',
        'item_no', 'vin_no', 'engine', 'drive', 'seats',
        'image', 'images', 'status', 'featured',
    ];

    protected $casts = [
        'images' => 'array',
        'year' => 'integer',
        'price' => 'integer',
        'mileage' => 'integer',
        'featured' => 'boolean',
    ];

    public static function nextCode(): string
    {
        $last = static::query()
            ->where('code', 'like', 'CAR-%')
            ->orderByRaw('CAST(SUBSTRING(code, 5) AS UNSIGNED) DESC')
            ->value('code');

        $next = $last ? ((int) substr($last, 4)) + 1 : 1;

        return 'CAR-' . str_pad((string) $next, 3, '0', STR_PAD_LEFT);
    }
}
