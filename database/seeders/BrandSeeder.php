<?php

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Seeder;

class BrandSeeder extends Seeder
{
    public function run(): void
    {
        $brands = [
            ['name' => 'Hyundai', 'logo' => 'hyundai', 'count' => 1412],
            ['name' => 'Kia', 'logo' => 'kia', 'count' => 1098],
            ['name' => 'Genesis', 'logo' => null, 'count' => 356],
            ['name' => 'Samsung', 'logo' => 'samsung', 'count' => 142],
            ['name' => 'Chevrolet', 'logo' => 'chevrolet', 'count' => 612],
            ['name' => 'SsangYong', 'logo' => null, 'count' => 284],
            ['name' => 'Audi', 'logo' => 'audi', 'count' => 731],
            ['name' => 'BMW', 'logo' => 'bmw', 'count' => 588],
            ['name' => 'Mercedes-Benz', 'logo' => 'mercedes', 'count' => 542],
            ['name' => 'Toyota', 'logo' => 'toyota', 'count' => 309],
            ['name' => 'Lexus', 'logo' => null, 'count' => 241],
            ['name' => 'Honda', 'logo' => 'honda', 'count' => 176],
            ['name' => 'Nissan', 'logo' => 'nissan', 'count' => 154],
            ['name' => 'Mitsubishi', 'logo' => 'mitsubishi', 'count' => 67],
            ['name' => 'Volvo', 'logo' => 'volvo', 'count' => 58],
            ['name' => 'Isuzu', 'logo' => null, 'count' => 118],
            ['name' => 'MAN', 'logo' => 'man', 'count' => 64],
            ['name' => 'Scania', 'logo' => 'scania', 'count' => 57],
            ['name' => 'Doosan', 'logo' => null, 'count' => 93],
            ['name' => 'Hyundai Construction Equipment', 'logo' => null, 'count' => 76],
            ['name' => 'Caterpillar', 'logo' => 'caterpillar', 'count' => 48],
        ];

        foreach ($brands as $brand) {
            Brand::updateOrCreate(['name' => $brand['name']], $brand + ['show' => true]);
        }
    }
}
