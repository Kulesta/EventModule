<?php

namespace Modules\Events\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Events\Entities\Event;

class EventController extends Controller
{
    /**
     * Display list of events
     */
    public function index()
    {
        $events = Event::latest()->paginate(10);
        return view('events::admin.events.index', compact('events'));
    }

    /**
     * Show form to create new event
     */
    public function create()
    {
        return view('events::admin.events.create');
    }

    /**
     * Store new event
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'venue' => 'required|string|max:255',
            'start_date' => 'required|date|after:now',
            'end_date' => 'required|date|after:start_date',
            'capacity' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
            'status' => 'required|in:draft,published,cancelled',
            'featured_image' => 'nullable|image|max:2048'
        ]);

        if ($request->hasFile('featured_image')) {
            $path = $request->file('featured_image')->store('events', 'public');
            $validated['featured_image'] = $path;
        }

        $validated['created_by'] = 1; // Temporary - fix later
        Event::create($validated);

        return redirect()->route('admin.events.index')
            ->with('success', 'Event created successfully!');
    }

    /**
     * Show edit form
     */
    public function edit($id)
    {
        $event = Event::findOrFail($id);
        return view('events::admin.events.edit', compact('event'));
    }

    /**
     * Update event
     */
    public function update(Request $request, $id)
    {
        $event = Event::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'venue' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'capacity' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
            'status' => 'required|in:draft,published,cancelled',
            'featured_image' => 'nullable|image|max:2048'
        ]);

        if ($request->hasFile('featured_image')) {
            $path = $request->file('featured_image')->store('events', 'public');
            $validated['featured_image'] = $path;
        }

        $event->update($validated);

        return redirect()->route('admin.events.index')
            ->with('success', 'Event updated successfully!');
    }

    /**
     * Delete event
     */
    public function destroy($id)
    {
        $event = Event::findOrFail($id);
        $event->delete();

        return redirect()->route('admin.events.index')
            ->with('success', 'Event deleted successfully!');
    }

    /**
     * Publish event
     */
    public function publish($id)
    {
        $event = Event::findOrFail($id);
        $event->update(['status' => 'published']);

        return redirect()->back()
            ->with('success', 'Event published successfully!');
    }
}