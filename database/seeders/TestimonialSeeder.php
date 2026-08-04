<?php

namespace Database\Seeders;

use App\Models\Testimonial;
use Illuminate\Database\Seeder;

class TestimonialSeeder extends Seeder
{
    public function run(): void
    {
        Testimonial::truncate();

        $testimonials = [
            ['author' => 'Amir Farouk', 'location' => 'Dubai, UAE', 'rating' => 5, 'avatar_initial' => 'AF', 'text' => 'The inspection report matched the car exactly when it arrived in Dubai. Shipping took nine days, faster than promised.'],
            ['author' => 'Ngozi Kalu', 'location' => 'Lagos, Nigeria', 'rating' => 5, 'avatar_initial' => 'NK', 'text' => 'Bought two Sportages for our fleet. The dealer coordination and paperwork support saved us weeks of back and forth.'],
            ['author' => 'Josefa Cruz', 'location' => 'Manila, Philippines', 'rating' => 5, 'avatar_initial' => 'JC', 'text' => 'First time importing a car myself. Support walked me through customs docs step by step — zero surprises.'],
            ['author' => 'Daniel Kimani', 'location' => 'Nairobi, Kenya', 'rating' => 5, 'avatar_initial' => 'DK', 'text' => 'Clear condition report, fair price, and the escrow payment made the whole thing feel safe from 6,000 miles away.'],
            ['author' => 'Rina Tanaka', 'location' => 'Auckland, New Zealand', 'rating' => 5, 'avatar_initial' => 'RT', 'text' => "I compared four export platforms and Hamza's inspection reports were by far the most detailed I saw."],
            ['author' => 'Omar Al-Sayed', 'location' => 'Amman, Jordan', 'rating' => 5, 'avatar_initial' => 'OM', 'text' => 'Customer support answered every question in under an hour, even across the time difference. Would buy again.'],
        ];

        foreach ($testimonials as $t) {
            Testimonial::create($t);
        }
    }
}
