<?php

namespace Database\Seeders;

use App\Models\Video;
use Illuminate\Database\Seeder;

class VideoSeeder extends Seeder
{
    public function run(): void
    {
        $videos = [
            [
                'title' => '2022 Hyundai Sonata Walkaround Review',
                'thumbnail' => '/assets/img/sonata.png',
                'duration' => '5:42',
                'views' => 3420,
                'published_at' => now()->subDays(2)->format('Y-m-d'),
            ],
            [
                'title' => 'Genesis G80 Luxury Sedan Highway Drive',
                'thumbnail' => '/assets/img/genesis_g80.png',
                'duration' => '8:15',
                'views' => 12180,
                'published_at' => now()->subWeek()->format('Y-m-d'),
            ],
            [
                'title' => 'Hyundai Starex: The Ultimate Export Van?',
                'thumbnail' => '/assets/img/starex.png',
                'duration' => '10:30',
                'views' => 8900,
                'published_at' => now()->subWeeks(2)->format('Y-m-d'),
            ],
            [
                'title' => 'Sporty Purple Kia K5 Design Tour',
                'thumbnail' => '/assets/img/kia_k5.png',
                'duration' => '6:12',
                'views' => 5600,
                'published_at' => now()->subWeeks(3)->format('Y-m-d'),
            ],
        ];

        foreach ($videos as $video) {
            Video::updateOrCreate(['title' => $video['title']], $video);
        }
    }
}
