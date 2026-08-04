<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\FaqRequest;
use App\Models\Faq;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    public function index(Request $request)
    {
        $faqs = Faq::query()
            ->when($request->filled('category'), fn ($query) => $query->where('category', $request->string('category')))
            ->orderBy('category')
            ->orderBy('id')
            ->get();

        return view('admin.faq', compact('faqs'));
    }

    public function form(Request $request)
    {
        $faq = $request->filled('id')
            ? Faq::findOrFail($request->integer('id'))
            : null;

        return view('admin.faq-form', compact('faq'));
    }

    public function store(FaqRequest $request)
    {
        Faq::create($request->validated());

        return redirect()->route('admin.faq')->with('status', 'FAQ added successfully.');
    }

    public function update(FaqRequest $request, Faq $faq)
    {
        $faq->update($request->validated());

        return redirect()->route('admin.faq')->with('status', 'FAQ updated successfully.');
    }

    public function destroy(Faq $faq)
    {
        $faq->delete();

        return redirect()->route('admin.faq')->with('status', 'FAQ deleted.');
    }
}
