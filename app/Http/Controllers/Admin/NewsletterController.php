<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\NewsletterSubscriber;
use Illuminate\Http\Request;

class NewsletterController extends Controller
{
    public function index(Request $request)
    {
        $subscribers = NewsletterSubscriber::query()
            ->when($request->filled('q'), fn ($query) => $query->where('email', 'like', '%'.$request->string('q').'%'))
            ->orderByDesc('id')
            ->paginate(20)
            ->withQueryString();

        $total = NewsletterSubscriber::count();

        return view('admin.newsletter', compact('subscribers', 'total'));
    }

    public function destroy(NewsletterSubscriber $subscriber)
    {
        $subscriber->delete();

        return back()->with('status', 'Subscriber removed.');
    }
}
