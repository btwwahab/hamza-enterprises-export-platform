<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = [
        'hero_badge', 'hero_headline', 'hero_subheadline',
        'stat_vehicles', 'stat_dealers', 'stat_countries',
        'company_name', 'email', 'address_korea', 'hamza_phone', 'fatima_phone',

        'showroom1_tag', 'showroom1_name', 'showroom1_address', 'showroom1_phone', 'showroom1_whatsapp', 'showroom1_maps_url',
        'showroom2_tag', 'showroom2_name', 'showroom2_address', 'showroom2_phone', 'showroom2_whatsapp', 'showroom2_maps_url',

        'leader1_tag', 'leader1_name', 'leader1_role', 'leader1_phone', 'leader1_whatsapp',
        'leader2_tag', 'leader2_name', 'leader2_role', 'leader2_phone', 'leader2_whatsapp',

        'bank1_tag', 'bank1_name',
        'bank1_row1_label', 'bank1_row1_value', 'bank1_row2_label', 'bank1_row2_value',
        'bank1_row3_label', 'bank1_row3_value', 'bank1_row4_label', 'bank1_row4_value',

        'bank2_tag', 'bank2_name',
        'bank2_row1_label', 'bank2_row1_value', 'bank2_row2_label', 'bank2_row2_value',
        'bank2_row3_label', 'bank2_row3_value', 'bank2_row4_label', 'bank2_row4_value',
    ];

    /**
     * This app has exactly one settings row.
     */
    public static function current(): self
    {
        return static::firstOrFail();
    }
}
