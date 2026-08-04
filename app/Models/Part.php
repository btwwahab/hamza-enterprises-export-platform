<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Part extends Model
{
    protected $fillable = [
        'code', 'name', 'description', 'maker', 'model', 'category', 'image', 'images', 'year', 'price', 'condition',
        'location', 'part_no', 'oem_no', 'engine_type', 'weight', 'fits_models',
        'hp', 'stock', 'status',
    ];

    protected $casts = [
        'images' => 'array',
        'year' => 'integer',
        'price' => 'integer',
        'stock' => 'integer',
    ];

    public static function nextCode(): string
    {
        $last = static::query()
            ->where('code', 'like', 'PART-%')
            ->orderByRaw('CAST(SUBSTRING(code, 6) AS UNSIGNED) DESC')
            ->value('code');

        $next = $last ? ((int) substr($last, 5)) + 1 : 1;

        return 'PART-' . str_pad((string) $next, 3, '0', STR_PAD_LEFT);
    }
}
