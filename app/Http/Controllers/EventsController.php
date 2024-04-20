<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\EventGuest;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

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
                'url' => route('events.show', ['id' => $event->id])
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
        $event = Event::findOrFail($request->id);
        return view('events.show')->with('event', $event);
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

    public function createGuest(Request $request)
    {
        return view('events.guest.create');
    }

    public function storeGuest(Request $request)
    {
        $id = $request->id;

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'contact_no' => ['required', 'string', 'max:255'],
            'photo' => ['required', 'string']
        ]);


        $imageData = $request->input('photo');
        $decodedImage = base64_decode(preg_replace('/^data:image\/(png|jpeg|jpg);base64,/', '', $imageData));
        $imageName = $request->name . Str::random(20) . '.png';
        file_put_contents(public_path('images/' . $imageName), $decodedImage);
        $imagePath = '/images/' . $imageName;


        EventGuest::create([
            'event_id' => $request->id,
            'name' => $request->name,
            'contact_no' => $request->contact_no,
            'photo' => $imagePath,

        ]);

        return redirect()->route('events.show', ['id' => $id]);
    }
}
