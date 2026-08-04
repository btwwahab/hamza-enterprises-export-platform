<?php

namespace Database\Seeders;

use App\Models\Inquiry;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class InquirySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $inquiries = [
            [
                'name' => 'Ibrahim Diallo',
                'email' => 'ibrahim.diallo@gmail.com',
                'phone' => '+224 622 45 67 89',
                'subject' => 'Shipping cost to Conakry, Guinea',
                'vehicle_interest' => '2022 Hyundai Palisade Prestige',
                'message' => "Hello, I'm interested in the Hyundai Palisade listed on your site. Can you tell me the total cost including shipping to Conakry port? Also do you handle the export documents?",
                'status' => 'Replied',
                'created_at' => Carbon::now()->subDays(9),
            ],
            [
                'name' => 'Fatima Al-Rashid',
                'email' => 'f.alrashid@outlook.com',
                'phone' => '+971 50 234 5678',
                'subject' => 'Bulk order — 5 pickup trucks',
                'vehicle_interest' => '2019 Hyundai Porter II Flatbed',
                'message' => 'We are a trading company based in Dubai looking to purchase 5 units of the Porter II Flatbed for resale. Please advise on bulk pricing and delivery timeline to Jebel Ali port.',
                'status' => 'Read',
                'created_at' => Carbon::now()->subDays(6),
            ],
            [
                'name' => 'Carlos Mendoza',
                'email' => 'carlos.mendoza82@yahoo.com',
                'phone' => '+51 987 654 321',
                'subject' => 'Inquiry about Genesis G80',
                'vehicle_interest' => '2023 Genesis G80 AWD Luxury',
                'message' => 'Good day, is the Genesis G80 still available? I would like to know the mileage and inspection report before proceeding with WhatsApp discussion.',
                'status' => 'New',
                'created_at' => Carbon::now()->subDays(4),
            ],
            [
                'name' => 'Grace Wanjiru',
                'email' => 'grace.wanjiru@hotmail.com',
                'phone' => '+254 712 345 678',
                'subject' => 'Payment methods and timeline',
                'vehicle_interest' => '2021 Kia Sportage Signature',
                'message' => "Hi Hamza Enterprises, I saw the Kia Sportage on your website. What payment methods do you accept for international buyers, and how long does shipping to Mombasa usually take?",
                'status' => 'New',
                'created_at' => Carbon::now()->subDays(3),
            ],
            [
                'name' => 'Youssef Benali',
                'email' => 'youssef.benali@gmail.com',
                'phone' => '+212 661 23 45 67',
                'subject' => 'Cargo truck availability',
                'vehicle_interest' => '2020 Kia Bongo III Cargo Truck',
                'message' => 'Assalamualaikum, I need a cargo truck for my business in Casablanca. Is the Bongo III still in stock and can I get more photos of the cargo bed condition?',
                'status' => 'Replied',
                'created_at' => Carbon::now()->subDays(2),
            ],
            [
                'name' => 'Elena Petrova',
                'email' => 'elena.petrova91@gmail.com',
                'phone' => '+995 555 12 34 56',
                'subject' => 'General question about your company',
                'vehicle_interest' => null,
                'message' => "Hello, this is my first time buying a used vehicle from South Korea. Can you explain the whole process from selection to delivery in Georgia? Do you have a showroom I can visit?",
                'status' => 'Read',
                'created_at' => Carbon::now()->subDay(),
            ],
            [
                'name' => 'Michael Okafor',
                'email' => 'mike.okafor@gmail.com',
                'phone' => '+234 803 456 7890',
                'subject' => 'Van for family use',
                'vehicle_interest' => '2020 Hyundai Starex Smart Van',
                'message' => "Good afternoon, I'm looking for a reliable van for my family of 8. Is the Starex Smart Van still available and what's the final price with shipping to Lagos?",
                'status' => 'New',
                'created_at' => Carbon::now()->subHours(14),
            ],
            [
                'name' => 'Daniel Osei',
                'email' => 'daniel.osei@yahoo.com',
                'phone' => '+233 24 567 8901',
                'subject' => 'SUV budget under $15,000',
                'vehicle_interest' => '2022 KG Mobility Rexton SUV',
                'message' => "Hi, I have a budget of around $15,000 including shipping to Tema port, Ghana. Does the Rexton SUV fit within this budget, or can you recommend something similar?",
                'status' => 'New',
                'created_at' => Carbon::now()->subHours(3),
            ],
        ];

        foreach ($inquiries as $inquiry) {
            $createdAt = $inquiry['created_at'];
            unset($inquiry['created_at']);

            $record = Inquiry::create($inquiry);
            $record->timestamps = false;
            $record->update(['created_at' => $createdAt, 'updated_at' => $createdAt]);
        }
    }
}
