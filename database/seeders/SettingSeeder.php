<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    public function run(): void
    {
        Setting::query()->updateOrCreate([], [
            'hero_badge' => 'Based in Incheon, South Korea',
            'hero_headline' => 'Reliable Korean used cars, trucks &amp; machinery, <span class="text-accent">exported worldwide.</span>',
            'hero_subheadline' => 'Hamza Enterprises specializes in supplying high-quality Korean used vehicles and heavy machinery to customers around the world — with competitive prices, professional service, and reliable shipping from Korea to your destination.',
            'stat_vehicles' => 743,
            'stat_dealers' => 74,
            'stat_countries' => 47,
            'company_name' => 'Hamza Enterprises',
            'email' => null,
            'address_korea' => 'Byeoksan Village, Yeonsu-gu, Incheon, South Korea',
            'hamza_phone' => '+82 10 6499 5384',
            'fatima_phone' => '+82 10 8030 1614',
            'office_hours_weekday' => 'Mon – Fri: 9:00 – 18:00 KST',
            'office_hours_saturday' => 'Saturday: 10:00 – 16:00 KST',
            'office_hours_sunday' => 'Sunday: Closed',

            'showroom1_tag' => 'Head Office',
            'showroom1_name' => 'Hamza Enterprises — Head Office',
            'showroom1_address' => 'Room 102, Building 11, Byeoksan Village, 348-141 Okryeon-dong, Yeonsu-gu, Incheon, South Korea',
            'showroom1_phone' => '+82 10 6499 5384',
            'showroom1_whatsapp' => '+82 10 6499 5384',
            'showroom1_maps_url' => 'https://www.google.com/maps/search/?api=1&query=' . urlencode('Byeoksan Village, Yeonsu-gu, Incheon, South Korea'),

            'showroom2_tag' => 'Export Yard',
            'showroom2_name' => 'Export Yard — Songdo',
            'showroom2_address' => 'Incheon Songdo, South Korea — stocking a wide range of Korean vehicles and machinery ready for export.',
            'showroom2_phone' => '+82 10 6499 5384',
            'showroom2_whatsapp' => '+82 10 6499 5384',
            'showroom2_maps_url' => 'https://www.google.com/maps/search/?api=1&query=' . urlencode('Incheon Songdo, South Korea'),

            'leader1_tag' => 'CEO · Fatima Trading',
            'leader1_name' => 'Muhammad Shahbaz',
            'leader1_role' => 'Chief Executive Officer',
            'leader1_phone' => '+82 10 8030 1614',
            'leader1_whatsapp' => '+82 10 8030 1614',

            'leader2_tag' => 'Manager · Hamza Enterprises',
            'leader2_name' => 'Hamza Khan Jadoon',
            'leader2_role' => 'Operations Manager',
            'leader2_phone' => '+82 10 6499 5384',
            'leader2_whatsapp' => '+82 10 6499 5384',

            'bank1_tag' => 'Fatima Trading',
            'bank1_name' => 'Kwangju Bank (광주은행)',
            'bank1_row1_label' => 'Account Name', 'bank1_row1_value' => 'Muhammad Shahbaz',
            'bank1_row2_label' => 'USD Account', 'bank1_row2_value' => '1107021332578',
            'bank1_row3_label' => 'KRW Account', 'bank1_row3_value' => '146121943050',
            'bank1_row4_label' => 'Account Code', 'bank1_row4_value' => '034',

            'bank2_tag' => 'Hamza Enterprises',
            'bank2_name' => 'KB Kookmin Bank (국민은행)',
            'bank2_row1_label' => 'Company Name', 'bank2_row1_value' => 'JADOON (HAMZA ENTERPRISES)',
            'bank2_row2_label' => 'KRW Account', 'bank2_row2_value' => '900901-01-707744',
            'bank2_row3_label' => 'USD Account', 'bank2_row3_value' => '900968-11-030116',
            'bank2_row4_label' => 'SWIFT Code', 'bank2_row4_value' => 'CZNBKRSEXXX',
        ]);
    }
}
