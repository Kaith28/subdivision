<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\EventGuest;
use App\Models\User;
use Carbon\Carbon;
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
                'title' => $event->event_purpose . " (" . $event->time . ")",
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
            'time' => 'required',
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
            'time' => $request->time,

        ]);
        return redirect()->route('events')->with('success', 'New event added');
    }

    public function show(Request $request)
    {
        $event = Event::findOrFail($request->id);
        $guests = $event->eventGuests()->paginate(15);

        $list = [];

        foreach ($guests as $guest) {
            $guard = User::findOrFail($guest->in_charge_id);

            $list[] = [
                'id' => $guest->id,
                'guard' => $guard->name,
                'name' => $guest->name,
                'contact_no' => $guest->contact_no,
                'created_at' => $guest->created_at === null ? "" :  Carbon::createFromFormat('Y-m-d H:i:s', $guest->created_at)->tz('Asia/Manila')->format('F j, Y g:i a'),
                'out' => $guest->out === null ? "" :  Carbon::createFromFormat('Y-m-d H:i:s', $guest->out)->tz('Asia/Manila')->format('F j, Y g:i a')
            ];
        }

        return view('events.show', [
            'event' => $event,
            'guests' => $guests,
            'list' => $list
        ]);
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
        $user = $request->user();
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
            'in_charge_id' => $user->id,
            'name' => $request->name,
            'contact_no' => $request->contact_no,
            'photo' => $imagePath,

        ]);

        return redirect()->route('events.show', ['id' => $id]);
    }

    public function showGuest(Request $request)
    {
        $id = $request->id;
        $guestId = $request->guest_id;

        $event = Event::findOrFail($id);
        $guest = $event->eventGuests()->findOrFail($guestId);

        return view('events.guest.show', [
            "event" => $event,
            "guest" => $guest
        ]);
    }

    public function destroyGuest(Request $request)
    {
        return view('events.guest.destroy');
    }

    public function guestOut(Request $request)
    {
        $id = $request->id;
        $guestId = $request->guest_id;

        $event = Event::findOrFail($id);
        $guest = $event->eventGuests()->findOrFail($guestId);

        $guest->out = date("Y-m-d H:i:s");
        $guest->save();

        return redirect()->route('events.show', $id)->with('success', 'Event Guest out successfully');
    }
}
