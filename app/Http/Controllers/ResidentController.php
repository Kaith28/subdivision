<?php

namespace App\Http\Controllers;

use App\Models\Guest;
use App\Models\Record;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class ResidentController extends Controller
{
    public function index(Request $request)
    {
        $name = $request->input('name');

        $users = User::query();

        if ($name !== null) {
            $users->where('name', 'LIKE', '%' . $name . '%');
        }

        $users->where('role', 'resident');
        $users->where('is_deleted', false);

        $users = $users->get();

        return view('resident.resident', [
            'users' => $users,
            'name'  => $name
        ]);
    }
    public function create()
    {
        return view('resident.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'position' => ['required', 'string', 'max:255'],
            'name' => ['required', 'string', 'max:255'],
            'contact_no' => ['required', 'string', 'max:255'],
            'vehicle_type' => ['required', 'string', 'max:255'],
            'plate_no' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
            'relatives' => ['required', 'string', 'max:255']

        ]);

        if ($request->hasFile('photo')) {
            $image = $request->file('photo');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);

            $imagePath = '/images/' . $imageName;

            User::create([
                'position' => $request->position,
                'name' => $request->name,
                'contact_no' => $request->contact_no,
                'vehicle_type' => $request->vehicle_type,
                'plate_no' => $request->plate_no,
                'address' => $request->address,
                'relatives' => $request->relatives,
                'photo' => $imagePath,
                'role' => 'resident'
            ]);
        }
        return redirect()->route('resident');
    }
    public function show(Request $request)
    {
        $user = user::findOrFail($request->id);
        return view('resident.show')->with('user', $user);
    }

    public function edit(Request $request)
    {
        $user = User::findOrFail($request->id);
        return view('resident.edit')
            ->with('user', $user);
    }

    public function update(Request $request)
    {
        $request->validate([
            'position' => ['required', 'string', 'max:255'],
            'name' => ['required', 'string', 'max:255'],
            'contact_no' => ['required', 'string', 'max:255'],
            'vehicle_type' => ['required', 'string', 'max:255'],
            'plate_no' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
            'relatives' => ['required', 'string', 'max:255'],
            // 'photo' => ['required', 'string'],
        ]);

        $user = User::findOrFail($request->id);

        $user->position = $request->position;
        $user->name = $request->name;
        $user->contact_no = $request->contact_no;
        $user->vehicle_type = $request->vehicle_type;
        $user->plate_no = $request->plate_no;
        $user->address = $request->address;
        $user->relatives = $request->relatives;

        $user->save();

        return redirect()->route('resident')->with('success', 'Updated user successfully');
    }
    public function destroy(Request $request)
    {
        $user = User::findOrFail($request->id);
        $user->is_deleted = true;

        $user->save();
        return redirect()->route('resident', $user->id)->with('success', 'User deleted successfully');
    }
    public function createGuest()
    {
        return view('guest.create');
    }

    public function storeGuest(Request $request)
    {
        $user = User::findOrFail($request->id);

        if ($request->hasFile('photo')) {
            $image = $request->file('photo');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);

            $imagePath = '/images/' . $imageName;


            Guest::create([
                'user_id' => $user->id,
                'name' => $request->name,
                'contact_no' => $request->contact_no,
                'photo' => $imagePath,

            ]);
        }
        return redirect()->route('guest');
    }

    public function enter(Request $request)
    {
        $user = User::findOrFail($request->id);
        $user->status = 'in';
        $user->save();

        $record = $user->records->where('in', null)->last();

        if ($record == null) {
            Record::create([
                'user_id' => $user->id,
                'in' => date("Y-m-d H:i:s")
            ]);
        } else {
            $record->in = date("Y-m-d H:i:s");
            $record->save();
        }

        return redirect()->route('resident', $user->id)->with('success', 'User enter successfully');
    }

    public function exit(Request $request)
    {
        $user = User::findOrFail($request->id);
        $user->status = 'out';
        $user->save();

        $record = $user->records->where('out', null)->last();

        if ($record == null) {
            Record::create([
                'user_id' => $user->id,
                'out' => date("Y-m-d H:i:s")
            ]);
        } else {
            $record->out = date("Y-m-d H:i:s");
            $record->save();
        }

        return redirect()->route('resident', $user->id)->with('success', 'User exit successfully');
    }

    public function changePhoto(Request $request)
    {

        if ($request->hasFile('photo')) {
            $image = $request->file('photo');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);

            $imagePath = '/images/' . $imageName;

            $user = User::findOrFail($request->id);
            $user->photo = $imagePath;
            $user->save();

            return redirect()->back()->with('success', 'Updated photo successfully');
        }
    }
}
