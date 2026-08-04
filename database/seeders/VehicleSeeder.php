<?php

namespace Database\Seeders;

use App\Models\Vehicle;
use Illuminate\Database\Seeder;

class VehicleSeeder extends Seeder
{
    public function run(): void
    {
        $vehicles = [
            [
                'code' => 'CAR-001', 'name' => '2022 Hyundai Sonata DOHC',
                'description' => "A well-kept 2022 Sonata with the smooth, efficient 2.0L DOHC engine and full automatic transmission. Single-owner history with complete service records, clean interior, and no accident damage. A dependable, fuel-friendly sedan that's ready for export and daily use straight off the boat.",
                'maker' => 'Hyundai', 'model' => 'Sonata', 'year' => 2022, 'price' => 12500, 'mileage' => 32000, 'fuel' => 'Gasoline', 'transmission' => 'Automatic', 'body' => 'Sedan', 'location' => 'Incheon Head Yard', 'image' => '/assets/img/sonata.png', 'images' => ['/assets/img/sonata.png', '/assets/img/sonata.png', '/assets/img/sonata.png'], 'item_no' => 'HE-9082', 'vin_no' => 'KMHCT41D8MA291**', 'engine' => '1999 CC', 'drive' => 'FWD', 'seats' => '5 Seats',
            ],
            [
                'code' => 'CAR-002', 'name' => '2023 Genesis G80 AWD Luxury',
                'description' => 'Low-mileage flagship sedan from Genesis with all-wheel drive and the full luxury trim — leather interior, premium sound system, and advanced driver-assist features. Barely broken in at just 12,000 km, this G80 presents like new and is one of our premium export listings.',
                'maker' => 'Genesis', 'model' => 'G80', 'year' => 2023, 'price' => 15800, 'mileage' => 12000, 'fuel' => 'Gasoline', 'transmission' => 'Automatic', 'body' => 'Sedan', 'location' => 'Incheon Head Yard', 'image' => '/assets/img/genesis_g80.png', 'images' => ['/assets/img/genesis_g80.png', '/assets/img/hero_car.png'], 'item_no' => 'HE-7643', 'vin_no' => 'KMTGT41D8MA124**', 'engine' => '3470 CC', 'drive' => 'AWD', 'seats' => '5 Seats',
            ],
            [
                'code' => 'CAR-003', 'name' => '2022 Hyundai Palisade Prestige',
                'description' => "Spacious 3-row family SUV with the efficient 2.2L diesel engine and full-time AWD for confident handling in any terrain. Comfortably seats seven with plenty of cargo room behind the third row — a popular choice for large families and fleet buyers alike.",
                'maker' => 'Hyundai', 'model' => 'Palisade', 'year' => 2022, 'price' => 21500, 'mileage' => 45000, 'fuel' => 'Diesel', 'transmission' => 'Automatic', 'body' => 'SUV', 'location' => 'Incheon Yard II', 'image' => '/assets/img/palisade.png', 'images' => ['/assets/img/palisade.png', '/assets/img/palisade.png', '/assets/img/palisade.png'], 'item_no' => 'HE-1249', 'vin_no' => 'KMHCU41D8MA105**', 'engine' => '2199 CC', 'drive' => 'AWD', 'seats' => '7 Seats',
            ],
            [
                'code' => 'CAR-004', 'name' => '2021 Kia Sportage Signature',
                'description' => 'Compact SUV running on economical LPG fuel, ideal for buyers looking to minimize running costs. Signature trim includes upgraded interior finishes and a full suite of convenience features. Higher mileage reflects honest daily use, with maintenance kept current throughout.',
                'maker' => 'Kia', 'model' => 'Sportage', 'year' => 2021, 'price' => 11200, 'mileage' => 67000, 'fuel' => 'LPG', 'transmission' => 'Automatic', 'body' => 'SUV', 'location' => 'Incheon Head Yard', 'image' => '/assets/img/sportage.png', 'images' => ['/assets/img/sportage.png', '/assets/img/sportage.png', '/assets/img/sportage.png'], 'item_no' => 'HE-4590', 'vin_no' => 'KNADN41D8MA340**', 'engine' => '1999 CC', 'drive' => 'FWD', 'seats' => '5 Seats',
            ],
            [
                'code' => 'CAR-005', 'name' => '2022 Hyundai Tucson Hybrid',
                'description' => "Fuel-efficient hybrid SUV combining a 1.6L engine with electric assist for excellent mileage without sacrificing power. Clean condition inside and out, with the Tucson's practical cargo layout and modern safety tech intact.",
                'maker' => 'Hyundai', 'model' => 'Tucson', 'year' => 2022, 'price' => 14900, 'mileage' => 28000, 'fuel' => 'Hybrid', 'transmission' => 'Automatic', 'body' => 'SUV', 'location' => 'Pyeongtaek Port Yard', 'image' => '/assets/img/tucson.png', 'images' => ['/assets/img/tucson.png', '/assets/img/tucson.png', '/assets/img/tucson.png'], 'item_no' => 'HE-8291', 'vin_no' => 'KMHCN41D8MA081**', 'engine' => '1598 CC', 'drive' => 'FWD', 'seats' => '5 Seats',
            ],
            [
                'code' => 'CAR-006', 'name' => '2021 Kia K5 Sport Turbo',
                'description' => 'Sporty midsize sedan with a turbocharged engine for confident acceleration. Sleek styling, comfortable cabin, and a strong daily driver for buyers who want a bit more performance without stepping up to a larger vehicle.',
                'maker' => 'Kia', 'model' => 'K5', 'year' => 2021, 'price' => 10800, 'mileage' => 54000, 'fuel' => 'Gasoline', 'transmission' => 'Automatic', 'body' => 'Sedan', 'location' => 'Incheon Yard II', 'image' => '/assets/img/kia_k5.png', 'images' => ['/assets/img/kia_k5.png', '/assets/img/kia_k5.png', '/assets/img/kia_k5.png'], 'item_no' => 'HE-3812', 'vin_no' => 'KNAGU41D8MA098**', 'engine' => '1999 CC', 'drive' => 'FWD', 'seats' => '5 Seats',
            ],
            [
                'code' => 'CAR-007', 'name' => '2021 Kia Carnival Limousine',
                'description' => '9-seat family/limousine-spec van with a torquey 2.2L diesel engine, well suited for large families, shuttle service, or group transport. Comfortable second and third-row seating with generous legroom throughout.',
                'maker' => 'Kia', 'model' => 'Carnival', 'year' => 2021, 'price' => 17500, 'mileage' => 62000, 'fuel' => 'Diesel', 'transmission' => 'Automatic', 'body' => 'Van', 'location' => 'Incheon Head Yard', 'image' => '/assets/img/carnival.png', 'images' => ['/assets/img/carnival.png', '/assets/img/carnival.png', '/assets/img/carnival.png'], 'item_no' => 'HE-5690', 'vin_no' => 'KNAGW41D8MA092**', 'engine' => '2199 CC', 'drive' => 'FWD', 'seats' => '9 Seats',
            ],
            [
                'code' => 'CAR-008', 'name' => '2020 Hyundai Starex Smart Van',
                'description' => 'High-capacity 11-seat van built for commercial and passenger transport work. The rear-wheel-drive Starex handles heavier loads confidently, and the diesel engine delivers solid fuel economy for its size — a proven workhorse for export buyers running shuttle or transport operations.',
                'maker' => 'Hyundai', 'model' => 'Starex', 'year' => 2020, 'price' => 11800, 'mileage' => 98000, 'fuel' => 'Diesel', 'transmission' => 'Automatic', 'body' => 'Van', 'location' => 'Pyeongtaek Port Yard', 'image' => '/assets/img/starex.png', 'images' => ['/assets/img/starex.png', '/assets/img/starex.png', '/assets/img/starex.png'], 'item_no' => 'HE-7812', 'vin_no' => 'KMHCW41D8MA192**', 'engine' => '2497 CC', 'drive' => 'RWD', 'seats' => '11 Seats',
            ],
            [
                'code' => 'CAR-009', 'name' => '2019 Hyundai Porter II Flatbed',
                'description' => "One of Korea's most trusted light commercial trucks, this Porter II flatbed is built for hauling and everyday trade work. Higher mileage reflects genuine commercial use, and the manual transmission keeps maintenance simple and affordable for fleet operators.",
                'maker' => 'Hyundai', 'model' => 'Porter II', 'year' => 2019, 'price' => 8200, 'mileage' => 120000, 'fuel' => 'Diesel', 'transmission' => 'Manual', 'body' => 'Truck', 'location' => 'Incheon Yard II', 'image' => '/assets/img/porter.png', 'images' => ['/assets/img/porter.png', '/assets/img/porter.png', '/assets/img/porter.png'], 'item_no' => 'HE-2194', 'vin_no' => 'KMHDB41D8MA902**', 'engine' => '2497 CC', 'drive' => 'RWD', 'seats' => '3 Seats',
            ],
            [
                'code' => 'CAR-010', 'name' => '2020 Kia Bongo III Cargo Truck',
                'description' => "Reliable cargo truck from Kia's Bongo III line, a mainstay for small businesses and logistics operators across Korea. Manual gearbox, rear-wheel drive, and a durable diesel engine make this a practical, low-cost workhorse ready for export.",
                'maker' => 'Kia', 'model' => 'Bongo III', 'year' => 2020, 'price' => 9500, 'mileage' => 105000, 'fuel' => 'Diesel', 'transmission' => 'Manual', 'body' => 'Truck', 'location' => 'Incheon Yard II', 'image' => '/assets/img/bongo.png', 'images' => ['/assets/img/bongo.png', '/assets/img/bongo.png', '/assets/img/bongo.png'], 'item_no' => 'HE-1095', 'vin_no' => 'KNADB41D8MA482**', 'engine' => '2497 CC', 'drive' => 'RWD', 'seats' => '3 Seats',
            ],
            [
                'code' => 'CAR-011', 'name' => '2022 KG Mobility Rexton SUV',
                'description' => 'Rugged 7-seat SUV with genuine 4WD capability and a torquey diesel engine, well suited to buyers who need real off-road ability alongside family-friendly seating. Well-maintained with low-to-moderate mileage for its year.',
                'maker' => 'SsangYong', 'model' => 'Rexton', 'year' => 2022, 'price' => 18200, 'mileage' => 39000, 'fuel' => 'Diesel', 'transmission' => 'Automatic', 'body' => 'SUV', 'location' => 'Pyeongtaek Port Yard', 'image' => '/assets/img/rexton.png', 'images' => ['/assets/img/rexton.png', '/assets/img/rexton.png', '/assets/img/rexton.png'], 'item_no' => 'HE-6091', 'vin_no' => 'KPSCT41D8MA491**', 'engine' => '2157 CC', 'drive' => '4WD', 'seats' => '7 Seats',
            ],
            [
                'code' => 'CAR-012', 'name' => '2020 Chevrolet Spark Compact',
                'description' => 'Compact, budget-friendly city car with excellent fuel economy and easy parking in tight urban spaces. A great entry-level export option or second vehicle, with straightforward maintenance and low running costs.',
                'maker' => 'Chevrolet', 'model' => 'Spark', 'year' => 2020, 'price' => 5400, 'mileage' => 41000, 'fuel' => 'Gasoline', 'transmission' => 'Automatic', 'body' => 'Sedan', 'location' => 'Dubai Showroom', 'image' => '/assets/img/spark.png', 'images' => ['/assets/img/spark.png', '/assets/img/spark.png', '/assets/img/spark.png'], 'item_no' => 'HE-3481', 'vin_no' => 'KL3CT51D8MA129**', 'engine' => '999 CC', 'drive' => 'FWD', 'seats' => '5 Seats',
            ],
        ];

        foreach ($vehicles as $vehicle) {
            Vehicle::updateOrCreate(['code' => $vehicle['code']], $vehicle + ['status' => 'Available']);
        }
    }
}
