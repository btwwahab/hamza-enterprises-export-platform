<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\TestimonialRequest;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class TestimonialController extends Controller
{
    public function index()
    {
        $testimonials = Testimonial::orderByDesc('id')->get();

        return view('admin.testimonials', compact('testimonials'));
    }

    public function form(Request $request)
    {
        $testimonial = $request->filled('id')
            ? Testimonial::findOrFail($request->integer('id'))
            : null;

        return view('admin.testimonials-form', compact('testimonial'));
    }

    public function store(TestimonialRequest $request)
    {
        $data = $request->validated();
        $data['avatar_color'] = $request->boolean('use_custom_color') ? ($data['avatar_color'] ?? null) : null;

        Testimonial::create($data);

        return redirect()->route('admin.testimonials')->with('status', 'Testimonial added successfully.');
    }

    public function update(TestimonialRequest $request, Testimonial $testimonial)
    {
        $data = $request->validated();
        $data['avatar_color'] = $request->boolean('use_custom_color') ? ($data['avatar_color'] ?? null) : null;

        $testimonial->update($data);

        return redirect()->route('admin.testimonials')->with('status', 'Testimonial updated successfully.');
    }

    public function destroy(Testimonial $testimonial)
    {
        $testimonial->delete();

        return redirect()->route('admin.testimonials')->with('status', 'Testimonial deleted.');
    }
}
