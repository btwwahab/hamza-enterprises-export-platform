<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Machinery extends Model
{
    protected $table = 'machinery';

    protected $fillable = [
        'code', 'name', 'description', 'maker', 'model', 'category', 'year', 'price', 'hours',
        'fuel', 'capacity', 'location',
        'item_no', 'serial_no', 'engine',
        'image', 'images', 'status',
    ];

    protected $casts = [
        'images' => 'array',
        'year' => 'integer',
        'price' => 'integer',
        'hours' => 'integer',
    ];

    public static function nextCode(): string
    {
        $last = static::query()
            ->where('code', 'like', 'MACH-%')
            ->orderByRaw('CAST(SUBSTRING(code, 6) AS UNSIGNED) DESC')
            ->value('code');

        $next = $last ? ((int) substr($last, 5)) + 1 : 1;

        return 'MACH-' . str_pad((string) $next, 3, '0', STR_PAD_LEFT);
    }
}
