<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventsController extends Controller
{

    public function index(Request $request)
    {
        $events = Event::get();

        $list = [];

        foreach ($events as $event) {
            $list[] = [
                'title' => $event->event_purpose . " (" . $event->organizer . ")",
                'start' => $event->end_time,
                'end' => $event->end_time,
            ];
        }

        return view('events.events', [
            'list' => $list
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'organizer' => 'required',
            'address' => 'required',
            'contact_no' => 'required',
            'event_location' => 'required',
            'event_purpose' => 'required',
            'estimated_attendees' => 'required',
        ]);

        Event::create([
            'organizer' => $request->organizer,
            'address' => $request->address,
            'contact_no' => $request->contact_no,
            'event_location' => $request->event_location,
            'event_purpose' => $request->event_purpose,
            'estimated_attendees' => $request->estimated_attendees,
            'start_time' => $request->date,
            'end_time' => $request->date,
        ]);
        return redirect()->route('events')->with('success', 'New event added');
    }




    public function show(Request $request)
    {
        $user = $request->user();
    }




    public function edit(Request $request)
    {
        $user = $request->user();
        return view('events.edit');
    }




    public function update(Request $request)
    {
        $user = $request->user();
        return view('events.update');
    }




    public function destroy(Request $request)
    {
        $user = $request->user();
        return view('events.destroy');
    }
}
