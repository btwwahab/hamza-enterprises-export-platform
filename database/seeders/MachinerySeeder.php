<?php

namespace Database\Seeders;

use App\Models\Machinery;
use Illuminate\Database\Seeder;

class MachinerySeeder extends Seeder
{
    public function run(): void
    {
        $machines = [
            [
                'code' => 'MACH-001', 'name' => '2021 Hyundai R220LC-9 Excavator',
                'description' => 'Mid-size 22-ton crawler excavator with a fuel-efficient Cummins engine and reinforced boom for heavy digging work. Well-maintained with routine service history — a versatile choice for general construction, foundation work, and demolition.',
                'maker' => 'Hyundai', 'model' => 'R220LC-9', 'category' => 'Construction Machinery', 'year' => 2021, 'price' => 68500, 'hours' => 4200, 'fuel' => 'Diesel', 'capacity' => '22 Tons', 'location' => 'Incheon Head Yard', 'item_no' => 'HE-M-2201', 'serial_no' => 'HHKHZ411KMA00291', 'engine' => 'Cummins B5.9 6800cc', 'image' => '/assets/img/machinery/excavator.svg', 'images' => ['/assets/img/machinery/excavator.svg'], 'status' => 'Available',
            ],
            [
                'code' => 'MACH-002', 'name' => '2020 Doosan DX225LC Excavator',
                'description' => 'Reliable 22.5-ton excavator built for heavy-duty earthmoving and trenching. Strong breakout force and smooth hydraulics throughout — inspected and ready to load for export.',
                'maker' => 'Doosan', 'model' => 'DX225LC', 'category' => 'Construction Machinery', 'year' => 2020, 'price' => 61500, 'hours' => 5100, 'fuel' => 'Diesel', 'capacity' => '22.5 Tons', 'location' => 'Incheon Yard II', 'item_no' => 'HE-M-2202', 'serial_no' => 'DHKDX225LKMA00874', 'engine' => 'Doosan DL06 5890cc', 'image' => '/assets/img/machinery/excavator.svg', 'images' => ['/assets/img/machinery/excavator.svg'], 'status' => 'Available',
            ],
            [
                'code' => 'MACH-003', 'name' => '2022 Hyundai HL760-9 Wheel Loader',
                'description' => 'Powerful wheel loader with a large bucket capacity, ideal for material handling, stockpiling, and loading trucks on active job sites. Low operating hours for its year with a clean maintenance record.',
                'maker' => 'Hyundai', 'model' => 'HL760-9', 'category' => 'Construction Machinery', 'year' => 2022, 'price' => 74000, 'hours' => 2100, 'fuel' => 'Diesel', 'capacity' => '3.2 m³ Bucket', 'location' => 'Incheon Head Yard', 'item_no' => 'HE-M-2203', 'serial_no' => 'HHKHL760KMA01142', 'engine' => 'Cummins QSB6.7 6700cc', 'image' => '/assets/img/machinery/wheel-loader.svg', 'images' => ['/assets/img/machinery/wheel-loader.svg'], 'status' => 'Available',
            ],
            [
                'code' => 'MACH-004', 'name' => '2019 Doosan D65S Crawler Bulldozer',
                'description' => 'Heavy crawler bulldozer built for grading, land clearing, and pushing large volumes of material. Undercarriage and blade show honest wear consistent with its hours — a dependable machine for large-scale earthwork.',
                'maker' => 'Doosan', 'model' => 'D65S', 'category' => 'Construction Machinery', 'year' => 2019, 'price' => 79500, 'hours' => 6300, 'fuel' => 'Diesel', 'capacity' => '16 Tons', 'location' => 'Pyeongtaek Port Yard', 'item_no' => 'HE-M-2204', 'serial_no' => 'DHKD65SKMA00567', 'engine' => 'Doosan DE12 11149cc', 'image' => '/assets/img/machinery/bulldozer.svg', 'images' => ['/assets/img/machinery/bulldozer.svg'], 'status' => 'Available',
            ],
            [
                'code' => 'MACH-005', 'name' => '2021 Hyundai 25-Ton Truck Crane',
                'description' => 'Mobile truck-mounted crane rated to 25 tons, with telescoping boom and outriggers for stable lifts on uneven ground. Well suited to steel erection, precast placement, and general lifting work on export or domestic sites.',
                'maker' => 'Hyundai', 'model' => 'HTC-250', 'category' => 'Heavy Equipment', 'year' => 2021, 'price' => 92000, 'hours' => 3400, 'fuel' => 'Diesel', 'capacity' => '25 Tons Lift', 'location' => 'Incheon Head Yard', 'item_no' => 'HE-M-2205', 'serial_no' => 'HHKHTC250KMA00312', 'engine' => 'Hyundai D6CA 9959cc', 'image' => '/assets/img/machinery/crane.svg', 'images' => ['/assets/img/machinery/crane.svg'], 'status' => 'Available',
            ],
            [
                'code' => 'MACH-006', 'name' => '2020 Doosan D30S Diesel Forklift',
                'description' => '3-ton diesel forklift for warehouse and yard material handling. Mast and forks in good working order, tested under load before listing — a practical addition for any logistics or export operation.',
                'maker' => 'Doosan', 'model' => 'D30S-7', 'category' => 'Heavy Equipment', 'year' => 2020, 'price' => 18500, 'hours' => 3900, 'fuel' => 'Diesel', 'capacity' => '3 Ton Lift', 'location' => 'Incheon Yard II', 'item_no' => 'HE-M-2206', 'serial_no' => 'DHKD30SKMA00983', 'engine' => 'Doosan D24 2500cc', 'image' => '/assets/img/machinery/forklift.svg', 'images' => ['/assets/img/machinery/forklift.svg'], 'status' => 'Available',
            ],
            [
                'code' => 'MACH-007', 'name' => '2021 Hyundai HR120C-9 Road Roller',
                'description' => '12-ton tandem road roller for asphalt and sub-base compaction. Smooth drum surfaces with no dents or damage, vibration system tested and functioning correctly.',
                'maker' => 'Hyundai', 'model' => 'HR120C-9', 'category' => 'Heavy Equipment', 'year' => 2021, 'price' => 54500, 'hours' => 2800, 'fuel' => 'Diesel', 'capacity' => '12 Tons', 'location' => 'Pyeongtaek Port Yard', 'item_no' => 'HE-M-2207', 'serial_no' => 'HHKHR120KMA00445', 'engine' => 'Cummins B4.5 4500cc', 'image' => '/assets/img/machinery/road-roller.svg', 'images' => ['/assets/img/machinery/road-roller.svg'], 'status' => 'Available',
            ],
            [
                'code' => 'MACH-008', 'name' => '2022 LS Mtron MT7 Agricultural Tractor',
                'description' => 'Mid-horsepower agricultural tractor well suited to plowing, tilling, and general farm work. Compact enough for smallholder farms while still delivering strong pulling power — one of our most requested agricultural exports.',
                'maker' => 'LS Mtron', 'model' => 'MT7.75', 'category' => 'Agricultural Machinery', 'year' => 2022, 'price' => 32500, 'hours' => 1400, 'fuel' => 'Diesel', 'capacity' => '75 HP', 'location' => 'Incheon Head Yard', 'item_no' => 'HE-M-2208', 'serial_no' => 'LSKMT775KMA00198', 'engine' => 'LS Mtron 3800cc', 'image' => '/assets/img/machinery/tractor.svg', 'images' => ['/assets/img/machinery/tractor.svg'], 'status' => 'Available',
            ],
            [
                'code' => 'MACH-009', 'name' => '2020 Kukje Daedong DK551 Tractor',
                'description' => 'Compact utility tractor ideal for orchard, vineyard, and small-plot farming. Economical to run and simple to maintain, with a straightforward parts supply chain for long-term ownership.',
                'maker' => 'Daedong', 'model' => 'DK551', 'category' => 'Agricultural Machinery', 'year' => 2020, 'price' => 19800, 'hours' => 2600, 'fuel' => 'Diesel', 'capacity' => '55 HP', 'location' => 'Incheon Yard II', 'item_no' => 'HE-M-2209', 'serial_no' => 'DDKDK551KMA00764', 'engine' => 'Daedong 2600cc', 'image' => '/assets/img/machinery/tractor.svg', 'images' => ['/assets/img/machinery/tractor.svg'], 'status' => 'Available',
            ],
            [
                'code' => 'MACH-010', 'name' => '2021 Daedong DH6135 Combine Harvester',
                'description' => 'Rice and grain combine harvester with a wide cutting header and large grain tank to minimize unloading stops. Cutting blades and threshing components in good working condition, ready for the next harvest season.',
                'maker' => 'Daedong', 'model' => 'DH6135', 'category' => 'Agricultural Machinery', 'year' => 2021, 'price' => 47500, 'hours' => 980, 'fuel' => 'Diesel', 'capacity' => '2.8 m³ Grain Tank', 'location' => 'Pyeongtaek Port Yard', 'item_no' => 'HE-M-2210', 'serial_no' => 'DDKDH6135KMA00352', 'engine' => 'Daedong 6100cc', 'image' => '/assets/img/machinery/harvester.svg', 'images' => ['/assets/img/machinery/harvester.svg'], 'status' => 'Available',
            ],
        ];

        foreach ($machines as $machine) {
            Machinery::updateOrCreate(['code' => $machine['code']], $machine);
        }
    }
}
