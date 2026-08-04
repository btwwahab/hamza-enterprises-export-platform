<?php

namespace App\Http\Controllers;

use App\Http\Requests\InquiryRequest;
use App\Models\Inquiry;

class InquiryController extends Controller
{
    public function store(InquiryRequest $request)
    {
        Inquiry::create($request->validated() + ['status' => 'New']);

        return back()->with('status', 'Thank you! Your message has been sent successfully. Our team will reply within 24 hours.');
    }
}
