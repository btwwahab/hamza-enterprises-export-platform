<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\EventRequest;
use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index(Request $request)
    {
        $events = Event::query()
            ->when($request->filled('q'), fn ($query) => $query->where('title', 'like', '%' . $request->string('q') . '%'))
            ->when($request->filled('category'), fn ($query) => $query->where('category', $request->string('category')))
            ->orderByDesc('event_date')
            ->paginate(10)
            ->withQueryString();

        return view('admin.events', compact('events'));
    }

    public function form(Request $request)
    {
        $event = $request->filled('id')
            ? Event::findOrFail($request->integer('id'))
            : null;

        return view('admin.events-form', compact('event'));
    }

    public function store(EventRequest $request)
    {
        $data = $request->validated();
        $data['code'] = Event::nextCode();

        if ($request->hasFile('image')) {
            $data['image'] = '/storage/' . $request->file('image')->store('events', 'public');
        }

        Event::create($data);

        return redirect()->route('admin.events')->with('status', 'Event added successfully.');
    }

    public function update(EventRequest $request, Event $event)
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            $data['image'] = '/storage/' . $request->file('image')->store('events', 'public');
        }

        $event->update($data);

        return redirect()->route('admin.events')->with('status', 'Event updated successfully.');
    }

    public function destroy(Event $event)
    {
        $event->delete();

        return redirect()->route('admin.events')->with('status', 'Event deleted.');
    }
}
