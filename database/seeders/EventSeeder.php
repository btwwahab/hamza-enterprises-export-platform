<?php

namespace Database\Seeders;

use App\Models\Event;
use Illuminate\Database\Seeder;

class EventSeeder extends Seeder
{
    public function run(): void
    {
        $events = [
            ['code' => 'EVENT-001', 'title' => 'Hamza Enterprises Export Reunion Celebration 2026', 'category' => 'Events', 'event_date' => '2026-07-20', 'author' => 'Admin Desk', 'shares_count' => 148, 'image' => '/assets/img/hero_car.png', 'summary' => 'Our annual export partner reunion event was held at Incheon Head Office, celebrating 12,000+ units exported globally.', 'content' => 'We welcomed over 80 international vehicle distributors and shipping partners to our Incheon headquarters this week. The ceremony honored our top logistics lines and debuted our expanded Songdo inspection complex, which doubles our capacity for pre-export structural checks.'],
            ['code' => 'EVENT-002', 'title' => 'Port Operations: Loading Container Batch for Jebel Ali', 'category' => 'Port Logs', 'event_date' => '2026-07-18', 'author' => 'Incheon Port Supervisor', 'shares_count' => 89, 'image' => '/assets/img/genesis_g80.png', 'summary' => 'Live operations report: Three luxury sedans cleared custom inspections and are currently being loaded into 40ft containers.', 'content' => 'Our port operations team supervised the containerization of three pristine Genesis G80s bound for Jebel Ali, Dubai. All three vehicles underwent full vacuum sealing and block tie-down procedures to ensure zero cosmetic movement during transit. Maritime departure is set for Tuesday morning.'],
            ['code' => 'EVENT-003', 'title' => 'Expansion: New Dubai Showroom & Office Opening', 'category' => 'Company News', 'event_date' => '2026-07-12', 'author' => 'Management Board', 'shares_count' => 215, 'image' => '/assets/img/rexton.png', 'summary' => 'Hamza Enterprises opens its secondary sales and support desk in Al Awir Auto Market, Ras Al Khor, Dubai.', 'content' => 'We are thrilled to announce the official opening of our UAE branch. This new physical yard allows Middle Eastern and East African buyers to purchase pre-imported, custom-cleared South Korean vehicles directly on the spot, complete with immediate local registration support.'],
            ['code' => 'EVENT-004', 'title' => 'Pre-Export Delivery Checks: Hyundai Porter Batch', 'category' => 'Deliveries', 'event_date' => '2026-07-08', 'author' => 'Quality Team', 'shares_count' => 56, 'image' => '/assets/img/porter.png', 'summary' => 'A batch of six light commercial trucks completed their final 200-point inspection before heading to Busan port.', 'content' => 'Our technicians finalized road testing and engine diagnostics for six Hyundai Porter II flatbeds ordered by a logistics fleet in South America. Each vehicle has been certified with a clean frame history and equipped with a full inspection checklist folder.'],
            ['code' => 'EVENT-005', 'title' => 'August RoRo Ocean Shipping Schedule Finalized', 'category' => 'Port Logs', 'event_date' => '2026-06-28', 'author' => 'Logistics Desk', 'shares_count' => 74, 'image' => '/assets/img/sportage.png', 'summary' => 'August ocean freight slots from Incheon and Pyeongtaek ports are now officially open for bookings.', 'content' => 'We have finalized agreement contracts with EUKOR and Hyundai Glovis for RoRo vessel spaces departing in August. Due to high summer volumes, buyers are advised to submit purchase orders and customs paperwork at least 10 days before scheduled departure dates.'],
            ['code' => 'EVENT-006', 'title' => 'Happy Client Handover: Hyundai Palisade in Ajman', 'category' => 'Deliveries', 'event_date' => '2026-06-22', 'author' => 'Dubai Yard Rep', 'shares_count' => 112, 'image' => '/assets/img/palisade.png', 'summary' => 'Celebrating another successful shipment delivery and handover ceremony for our customer in the UAE.', 'content' => 'Mr. Farouk took delivery of his white 2022 Hyundai Palisade today. Sourced directly from our Namdong yard, shipped to Jebel Ali, and cleared through Dubai Customs in record time. We wish him and his family safe travels!'],
        ];

        foreach ($events as $event) {
            Event::updateOrCreate(['code' => $event['code']], $event);
        }
    }
}
