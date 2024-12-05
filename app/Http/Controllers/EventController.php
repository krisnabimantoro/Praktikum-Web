<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\EventDetail;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $events= Event::with('eventDetail')->get();
        return response()->json($events);;

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $eventDetail = EventDetail::create([
            'description' => $request->description,
            'date_event' => $request->date_event,
            'image_event' => $request->image_event,
            'name_location' => $request->name_location,
        ]);
        $event = Event::create([
            'name_event' => $request->name_event,
            'id_event_detail' => $eventDetail->id,
        ]);

        return response()->json([
            'message' => 'Event and EventDetail created successfully',
            'event' => $event,
            'event_detail' => $eventDetail,
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $event = Event::with('eventDetail')->findOrFail($id);

        return response()->json($event);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $event = Event::find($id);
        $eventDetail = $event->eventDetail;

        $eventDetail ->update([
            'description' => $request->description,
            'date_event' => $request->date_event,
            'image_event' => $request->image_event,
            'name_location' => $request->name_location,
        ]);
        $event ->update([
            'name_event' => $request->name_event,
            'id_event_detail' => $eventDetail->id,
        ]);

        return response()->json([
            'message' => 'Event and EventDetail updated successfully',
            'event' => $event,
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $event = Event::find($id);
        $eventDetail = $event->eventDetail;

        $event->delete();
        $eventDetail->delete();

        return response()->json([
            'message' => 'Event deleted successfully',

        ], 200);
    }
}