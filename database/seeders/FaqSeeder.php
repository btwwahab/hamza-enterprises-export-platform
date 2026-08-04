<?php

namespace Database\Seeders;

use App\Models\Faq;
use Illuminate\Database\Seeder;

class FaqSeeder extends Seeder
{
    public function run(): void
    {
        Faq::truncate();

        $faqs = [
            ['category' => 'Safety', 'question' => 'Is it safe to purchase cars at Hamza Enterprises?', 'answer' => 'Yes. Hamza Enterprises offers the safest way to buy vehicles through our safe payment &amp; shipping service. Also, Hamza Enterprises has 5 guaranteed programs for your safe trade.'],
            ['category' => 'Safety', 'question' => 'What are my benefits?', 'answer' => "Hamza Enterprises offers 5 Benefits for safe transactions:\n<ol>\n<li><strong>100% Refund Guarantee</strong> (in case of an unsuccessful shipment).</li>\n<li><strong>Quality Control System</strong>.</li>\n<li><strong>Lowest Price</strong>.</li>\n<li><strong>Full Customer Support</strong>.</li>\n<li><strong>Professional Shipping Team</strong>.</li>\n</ol>"],
            ['category' => 'Purchasing', 'question' => 'What is the process of purchasing cars?', 'answer' => "<ol>\n<li>Leave an Inquiry &amp; Quotation request on the item.</li>\n<li>Receive an official quotation from Hamza Enterprises.</li>\n<li>Confirm the quotation to purchase.</li>\n<li>Deposit the payment to Hamza Enterprises bank details.</li>\n<li>Wait for booking and shipping updates.</li>\n</ol>"],
            ['category' => 'Purchasing', 'question' => 'How can I pay?', 'answer' => "The payment's full amount must be 100% completed through a bank transfer, Western Union, or Moneygram. We do not accept partial payment, credit card, nor paypal."],
            ['category' => 'Purchasing', 'question' => 'How can I check the condition of the vehicle?', 'answer' => "You can check the vehicle's condition in detail with:\n<ol>\n<li>Vehicle Condition Report (VCR).</li>\n<li>A detailed walkaround video of the vehicle.</li>\n<li>More high-definition pictures (upon request).</li>\n<li>Confirm quotation to purchase.</li>\n<li>Wait for shipping.</li>\n</ol>\nIf you want to know more about the condition of the vehicle, you can use our professional pre-export Inspection service."],
            ['category' => 'Shipping', 'question' => 'Does the price include shipping cost?', 'answer' => 'No. Listed price is the item price only. It does not include ocean freight and other shipping related charges. Please select the shipping type you want. Some shipping types may have extra charges at the destination port. (Ro-Ro/Container/Consolidation). Hamza Enterprises will give you the final quotation of shipping to your destination port after submitting an inquiry.'],
            ['category' => 'Shipping', 'question' => 'Does the price include customs tax?', 'answer' => "No. The price does not include your country's custom import duties. You must clear customs by paying the tax separately. Please check the details with your local customs clearing agency."],
            ['category' => 'Shipping', 'question' => 'How long until the item arrives at my port?', 'answer' => 'Depending on the country, it can take from 10 - 55 days for items to reach designated ports. Hamza Enterprises books the fastest available shipping schedule immediately after payment is confirmed.'],
            ['category' => 'Company', 'question' => "Where is Hamza Enterprises' office located in?", 'answer' => 'Hamza Enterprises\' head office is located in Byeoksan Village, Yeonsu-gu, Incheon, South Korea. Our export loading yard is situated in Incheon Songdo, South Korea, and we ship worldwide from there.'],
            ['category' => 'Company', 'question' => 'Does Hamza Enterprises have an agent in my country?', 'answer' => 'We export directly from our Incheon office and yard to buyers worldwide, including Pakistan, the UAE, Saudi Arabia, and many other countries across the Middle East, Africa, and South America. Contact our team directly by phone or WhatsApp for support in your country.'],
        ];

        foreach ($faqs as $faq) {
            Faq::create($faq);
        }
    }
}
