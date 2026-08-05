<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@hamzaenterprises.com'],
            ['name' => 'Admin', 'password' => 'Hamza@2024']
        );

        $this->call([
            VehicleSeeder::class,
            MachinerySeeder::class,
            PartSeeder::class,
            EventSeeder::class,
            BrandSeeder::class,
            FaqSeeder::class,
            TestimonialSeeder::class,
            SettingSeeder::class,
            VideoSeeder::class,
            InquirySeeder::class,
        ]);
    }
}
