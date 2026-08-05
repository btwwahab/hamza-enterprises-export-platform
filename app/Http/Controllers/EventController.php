<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    protected function toJsShape(Event $e): array
    {
        return [
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
            'linkFacebook' => $e->link_facebook,
            'linkTwitter' => $e->link_twitter,
            'linkWhatsapp' => $e->link_whatsapp,
        ];
    }

    public function index()
    {
        $events = Event::orderByDesc('event_date')->get();

        $eventsDatabase = $events->map(fn ($e) => $this->toJsShape($e))->values();

        return view('pages.events', compact('eventsDatabase'));
    }

    public function show(Request $request)
    {
        $id = $request->query('id');

        $events = Event::orderByDesc('event_date')->get();
        $found = $events->firstWhere('code', $id);

        abort_if(! $found, 404);

        $eventsDatabase = $events->map(fn ($e) => $this->toJsShape($e))->values();

        return view('pages.event-detail', compact('eventsDatabase'));
    }
}
