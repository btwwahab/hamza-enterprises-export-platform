<?php

namespace App\Http\Controllers;

use App\Models\Faq;

class FaqController extends Controller
{
    public function index()
    {
        $categories = [
            'safety' => 'Safety',
            'purchasing' => 'Purchasing',
            'shipping' => 'Shipping',
            'company' => 'Company',
        ];

        $faqsByCategory = Faq::orderBy('id')->get()->groupBy('category');

        return view('pages.faq', compact('categories', 'faqsByCategory'));
    }
}
