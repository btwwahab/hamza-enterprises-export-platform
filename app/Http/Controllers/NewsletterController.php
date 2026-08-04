<?php

namespace App\Http\Controllers;

use App\Models\NewsletterSubscriber;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class NewsletterController extends Controller
{
    public function store(Request $request)
    {
        try {
            $data = $request->validate([
                'email' => ['required', 'email', 'max:150'],
            ]);
        } catch (ValidationException $e) {
            return response()->json(['message' => $e->getMessage()], 422);
        }

        NewsletterSubscriber::firstOrCreate(['email' => $data['email']]);

        return response()->json(['message' => 'Subscribed.']);
    }
}
