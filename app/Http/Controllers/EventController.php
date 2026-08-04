<?php

namespace App\Http\Controllers;

use App\Models\Event;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::orderByDesc('event_date')->get();

        $eventsDatabase = $events->map(fn ($e) => [
            'id' => $e->code,
            'title' => $e->title,
            'category' => $e->category,
            'date' => $e->event_date->format('F j, Y'),
            'dateDay' => $e->event_date->format('d'),
            'dateMonth' => strtoupper($e->event_date->format('M')),
            'summary' => $e->summary,
            'content' => $e->content,
            'image' => $e->image,
            'author' => $e->author,
            'sharesCount' => $e->shares_count,
        ])->values();

        return view('pages.events', compact('eventsDatabase'));
    }
}
