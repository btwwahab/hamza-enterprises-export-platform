<?php

namespace Database\Seeders;

use App\Models\Part;
use Illuminate\Database\Seeder;

class PartSeeder extends Seeder
{
    public function run(): void
    {
        $parts = [
            [
                'code' => 'PART-001', 'name' => 'Hyundai D4CB 2.5L CRDi Engine Assembly',
                'description' => 'Complete D4CB 2.5L CRDi engine assembly pulled from a low-mileage donor vehicle. Runs and compresses well, tested prior to listing. Fits a wide range of Hyundai/Kia commercial models — a cost-effective alternative to a brand-new unit.',
                'maker' => 'Hyundai', 'model' => 'Grand Starex', 'category' => 'Engine', 'year' => 2021, 'price' => 2450, 'condition' => 'Used', 'location' => 'Incheon Head Yard', 'part_no' => 'HE-P-8012', 'oem_no' => '21101-4A700', 'engine_type' => 'D4CB Euro 6', 'weight' => '220 kg', 'fits_models' => 'Grand Starex, Porter II, Kia Bongo III', 'hp' => '133 HP', 'status' => 'Available',
            ],
            [
                'code' => 'PART-002', 'name' => 'Kia Sportage D4FD 1.7L Engine Assembly',
                'description' => 'Turbocharged D4FD 1.7L CRDi engine in good working condition, removed from a well-maintained Sportage. A direct fit for several popular Hyundai/Kia crossover models — inspected and ready to ship.',
                'maker' => 'Kia', 'model' => 'Sportage', 'category' => 'Engine', 'year' => 2020, 'price' => 1800, 'condition' => 'Used', 'location' => 'Incheon Yard II', 'part_no' => 'HE-P-3021', 'oem_no' => '21101-2AA00', 'engine_type' => 'D4FD CRDi Turbo', 'weight' => '185 kg', 'fits_models' => 'Sportage, Hyundai Tucson, Kia K5', 'hp' => '141 HP', 'status' => 'Available',
            ],
            [
                'code' => 'PART-003', 'name' => 'Hyundai Porter II 6-Speed Manual Gearbox',
                'description' => 'Fully rebuilt 6-speed manual gearbox with new synchros and seals, tested for smooth shifting across all gears. A dependable choice for commercial truck operators looking to avoid the cost of a full replacement transmission.',
                'maker' => 'Hyundai', 'model' => 'Porter II', 'category' => 'Transmission', 'year' => 2019, 'price' => 750, 'condition' => 'Rebuilt', 'location' => 'Pyeongtaek Port Yard', 'part_no' => 'HE-P-4401', 'oem_no' => '43000-4A500', 'engine_type' => '6MT Commercial', 'weight' => '75 kg', 'fits_models' => 'Porter II, Kia Bongo III', 'hp' => '-', 'status' => 'Available',
            ],
            [
                'code' => 'PART-004', 'name' => 'Kia Bongo III 5-Speed Automatic Transmission',
                'description' => 'Heavy-duty 5-speed automatic transmission in solid working condition, well suited for commercial van and truck applications. Removed from a running vehicle and functionally tested before listing.',
                'maker' => 'Kia', 'model' => 'Bongo III', 'category' => 'Transmission', 'year' => 2021, 'price' => 1100, 'condition' => 'Used', 'location' => 'Incheon Head Yard', 'part_no' => 'HE-P-5612', 'oem_no' => '45000-4C200', 'engine_type' => '5AT Heavy Duty', 'weight' => '92 kg', 'fits_models' => 'Bongo III, Hyundai Porter II', 'hp' => '-', 'status' => 'Available',
            ],
            [
                'code' => 'PART-005', 'name' => 'Kia Carnival LED Projector Headlight Set',
                'description' => 'Complete left and right LED projector headlight set for the 4th-generation Carnival. Clean lenses with no cracking or fogging, all functions tested — a straightforward upgrade or replacement for damaged factory units.',
                'maker' => 'Kia', 'model' => 'Carnival', 'category' => 'Lighting', 'year' => 2022, 'price' => 480, 'condition' => 'Used', 'location' => 'Incheon Head Yard', 'part_no' => 'HE-P-9031', 'oem_no' => '92101-R5000 / 92102-R5000', 'engine_type' => 'LED Bi-Function', 'weight' => '14 kg', 'fits_models' => 'Carnival KA4 (4th Gen)', 'hp' => '-', 'status' => 'Available',
            ],
            [
                'code' => 'PART-006', 'name' => 'Genesis G80 Full LED Headlight Assembly (Right)',
                'description' => 'Brand-new right-side adaptive Matrix LED headlight assembly for the Genesis G80 (RG3). Factory-sealed, never installed — ideal for buyers wanting genuine-spec lighting without the wait on a dealer order.',
                'maker' => 'Genesis', 'model' => 'G80', 'category' => 'Lighting', 'year' => 2023, 'price' => 650, 'condition' => 'New', 'location' => 'Dubai Showroom', 'part_no' => 'HE-P-1182', 'oem_no' => '92102-T1000', 'engine_type' => 'Adaptive Matrix LED', 'weight' => '8 kg', 'fits_models' => 'Genesis G80 (RG3)', 'hp' => '-', 'status' => 'Reserved',
            ],
            [
                'code' => 'PART-007', 'name' => 'Hyundai Sonata LF Front Nose Cut Assembly',
                'description' => 'Complete front nose cut including bumper, radiator support, fan assembly, and headlights — a fast way to repair significant front-end damage without sourcing each part individually. Clean cut with no structural rust.',
                'maker' => 'Hyundai', 'model' => 'Sonata', 'category' => 'Body Parts', 'year' => 2018, 'price' => 1350, 'condition' => 'Used', 'location' => 'Incheon Yard II', 'part_no' => 'HE-P-2894', 'oem_no' => 'Sonata LF Front Cut', 'engine_type' => 'Bumper, Radiator, Fan & Lights', 'weight' => '160 kg', 'fits_models' => 'Sonata LF', 'hp' => '-', 'status' => 'Available',
            ],
            [
                'code' => 'PART-008', 'name' => 'KG Mobility Rexton Front Suspension Struts (Pair)',
                'description' => 'Brand-new front coilover strut pair for the Rexton platform, factory-sealed and ready to install. A direct OEM-spec replacement for worn or damaged factory struts.',
                'maker' => 'SsangYong', 'model' => 'Rexton', 'category' => 'Suspension', 'year' => 2021, 'price' => 320, 'condition' => 'New', 'location' => 'Pyeongtaek Port Yard', 'part_no' => 'HE-P-7281', 'oem_no' => '44310-36200', 'engine_type' => 'Coilover Shocks Assembly', 'weight' => '22 kg', 'fits_models' => 'G4 Rexton, Rexton Sports', 'hp' => '-', 'status' => 'Sold',
            ],
            [
                'code' => 'PART-009', 'name' => 'Honda Civic Front Shield Assembly',
                'description' => 'New front nose panel/shield assembly for the current-generation Civic, still in factory packaging. Protects the front-end structure and provides a clean base for any front-end repair work.',
                'maker' => 'Honda', 'model' => 'Civic', 'category' => 'Body Parts', 'year' => 2025, 'price' => 490, 'condition' => 'New', 'location' => 'Dubai Showroom', 'part_no' => 'HE-P-1092', 'oem_no' => '74111-TGG-A00', 'engine_type' => 'Nose Panel Protection', 'weight' => '8 kg', 'fits_models' => 'Honda Civic 2022-2025', 'hp' => '-', 'status' => 'Available',
            ],
            [
                'code' => 'PART-010', 'name' => 'Honda Accord Bus Head Light (Left/Right Set)',
                'description' => 'Matched left and right LED headlight set removed from a low-mileage Accord. Lenses are clear with no yellowing, all mounting tabs intact — tested and confirmed fully functional before listing.',
                'maker' => 'Honda', 'model' => 'Accord', 'category' => 'Lighting', 'year' => 2025, 'price' => 520, 'condition' => 'Used', 'location' => 'Incheon Head Yard', 'part_no' => 'HE-P-9005', 'oem_no' => '33100-TVA-A11', 'engine_type' => 'LED Assembly', 'weight' => '12 kg', 'fits_models' => 'Honda Accord 2023-2025', 'hp' => '-', 'status' => 'Reserved',
            ],
        ];

        foreach ($parts as $part) {
            Part::updateOrCreate(['code' => $part['code']], $part);
        }
    }
}
