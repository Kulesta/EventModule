<?php

namespace Modules\Events\Http\Controllers;

use Illuminate\Routing\Controller;
use Modules\Events\Entities\Event;

class EventController extends Controller
{
    /**
     * Show homepage with upcoming events
     * URL: GET /
     * View: events::public.index
     */
    public function index()
    {
        // Get 6 upcoming published events, sorted by soonest first
        $upcomingEvents = Event::where('status', 'published')
            ->where('start_date', '>', now())
            ->orderBy('start_date', 'asc')
            ->limit(6)
            ->get();

        return view('events::public.index', compact('upcomingEvents'));
    }

    /**
     * Show single event details page
     * URL: GET /events/{id}
     * View: events::public.show
     */
    public function show($id)
    {
        // Find the event or show 404
        $event = Event::where('status', 'published')
            ->where('id', $id)
            ->firstOrFail();

        return view('events::public.show', compact('event'));
    }
}