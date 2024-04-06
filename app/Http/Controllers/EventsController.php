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
                'start' => $event->start_time,
                'end' => $event->end_time,
            ];
        }

        return view('events.events', [
            'list' => $list
        ]);
    }





    public function create(Request $request)
    {
        $user = $request->user();
        return view('events.create');
    }




    public function store(Request $request)
    {
        $user = $request->user();
        return view('events.create');
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
