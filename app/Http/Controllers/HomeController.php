<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Event;
use App\Models\Setting;
use App\Models\Testimonial;
use App\Models\Vehicle;
use App\Models\Video;

class HomeController extends Controller
{
    protected function toListingShape(Vehicle $v): array
    {
        return [
            'id' => $v->code,
            'name' => $v->name,
            'year' => $v->year,
            'price' => $v->price,
            'mileage' => number_format($v->mileage) . ' mi',
            'fuel' => $v->fuel,
            'image' => $v->image,
            'location' => $v->location,
        ];
    }

    public function index()
    {
        $brands = Brand::where('show', true)
            ->orderBy('id')
            ->get()
            ->map(fn ($b) => [
                'name' => $b->name,
                'logo' => $b->logo,
                'count' => $b->count,
            ])
            ->values();

        $testimonials = Testimonial::orderBy('id')->get();
        $settings = Setting::current();

        // "Today's recommendation" shows admin-featured vehicles first, topped
        // up with the newest available stock if fewer than 6 are featured.
        $recommendation = Vehicle::where('status', '!=', 'Sold')
            ->where('featured', true)
            ->orderByDesc('id')
            ->take(6)
            ->get();

        if ($recommendation->count() < 6) {
            $fallback = Vehicle::where('status', '!=', 'Sold')
                ->whereNotIn('id', $recommendation->pluck('id'))
                ->orderByDesc('id')
                ->take(6 - $recommendation->count())
                ->get();
            $recommendation = $recommendation->concat($fallback);
        }

        $stock = Vehicle::where('status', '!=', 'Sold')
            ->orderByDesc('id')
            ->take(8)
            ->get();

        $recommendationData = $recommendation->map(fn ($v) => $this->toListingShape($v))->values();
        $stockData = $stock->map(fn ($v) => $this->toListingShape($v))->values();

        $portUpdates = Event::orderByDesc('event_date')
            ->take(4)
            ->get()
            ->map(fn ($e) => [
                'id' => $e->code,
                'tag' => $e->category,
                'date' => $e->event_date->format('F j, Y'),
                'title' => $e->title,
                'summary' => $e->summary,
                'image' => $e->image,
            ])
            ->values();

        $videos = Video::orderByDesc('published_at')
            ->take(4)
            ->get()
            ->map(fn ($v) => [
                'title' => $v->title,
                'thumbnail' => $v->thumbnail,
                'duration' => $v->duration,
                'views' => $v->views,
                'timeAgo' => $v->published_at->diffForHumans(),
                'url' => $v->video_url,
            ])
            ->values();

        return view('pages.home', compact('brands', 'testimonials', 'settings', 'recommendationData', 'stockData', 'portUpdates', 'videos'));
    }
}
