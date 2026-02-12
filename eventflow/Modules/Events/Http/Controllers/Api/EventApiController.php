<?php

namespace Modules\Events\Http\Controllers\Api;

use Illuminate\Routing\Controller;
use Modules\Events\Entities\Event;
use Illuminate\Http\Request;

class EventApiController extends Controller
{
    /**
     * GET /api/events - List all published events
     * Supports search and pagination
     */
    public function index(Request $request)
    {
        $events = Event::where('status', 'published')
            ->where('start_date', '>', now())
            ->when($request->search, function($query, $search) {
                return $query->where(function($q) use ($search) {
                    $q->where('title', 'like', "%{$search}%")
                      ->orWhere('description', 'like', "%{$search}%")
                      ->orWhere('venue', 'like', "%{$search}%");
                });
            })
            ->orderBy('start_date', 'asc')
            ->paginate($request->per_page ?? 15);

        return response()->json([
            'success' => true,
            'data' => $events,
            'message' => 'Events retrieved successfully'
        ]);
    }

    /**
     * GET /api/events/{id} - Get single event
     */
    public function show($id)
    {
        try {
            $event = Event::where('status', 'published')
                ->where('id', $id)
                ->firstOrFail();

            return response()->json([
                'success' => true,
                'data' => $event,
                'message' => 'Event retrieved successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Event not found'
            ], 404);
        }
    }

    /**
     * GET /api/events/upcoming - Get next 6 upcoming events
     */
    public function upcoming()
    {
        $events = Event::where('status', 'published')
            ->where('start_date', '>', now())
            ->orderBy('start_date', 'asc')
            ->limit(6)
            ->get();

        return response()->json([
            'success' => true,
            'data' => $events,
            'message' => 'Upcoming events retrieved successfully'
        ]);
    }
}