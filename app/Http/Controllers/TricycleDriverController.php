<?php

namespace App\Http\Controllers;

use App\Models\Record;
use App\Models\User;
use Illuminate\Http\Request;

class TricycleDriverController extends Controller
{
    public function index(Request $request)
    {
        $name = $request->input('name');

        $users = User::query();

        if ($name !== null) {
            $users->where('name', 'LIKE', '%' . $name . '%');
        }

        $users->where('role', 'driver');

        $users = $users->get();

        return view('tricycledriver.tricycledriver', [
            'users' => $users,
            'name'  => $name
        ]);
    }
    public function create()
    {
        return view('tricycledriver.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'contact_no' => ['required', 'string', 'max:255'],
            'plate_no' => ['required', 'string', 'max:255'],
            /* 'photo' => ['required', 'string'], */
        ]);
        if ($request->hasFile('photo')) {
            $image = $request->file('photo');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);

            $imagePath = '/images/' . $imageName;

            User::create([
                'name' => $request->name,
                'contact_no' => $request->contact_no,
                'plate_no' => $request->plate_no,
                'photo' => $imagePath,
                'role' => 'driver',
            ]);
        }

        return redirect()->route('tricycledriver');
    }
    public function show(Request $request)
    {
        $user = user::findOrFail($request->id);
        return view('tricycledriver.show')->with('user', $user);
    }

    public function edit(Request $request)
    {
        $user = User::findOrFail($request->id);
        return view('tricycledriver.edit')
            ->with('user', $user);
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'contact_no' => ['required', 'string', 'max:255'],
            'plate_no' => ['required', 'string', 'max:255'],
            'photo' => ['required', 'string'],
        ]);

        $user = User::findOrFail($request->id);

        $user->name = $request->name;
        $user->contact_no = $request->contact_no;
        $user->plate_no = $request->plate_no;

        $user->save();

        return redirect()->route('tricycledriver')->with('success', 'Updated user successfully');
    }
    public function destroy(Request $request)
    {
        $user = User::findOrFail($request->id);
        $user->delete();
        return redirect()->route('tricycledriver', $user->id)->with('success', 'User deleted successfully');
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
        return redirect()->route('tricycledriver', $user->id)->with('success', 'User enter successfully');
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
        return redirect()->route('tricycledriver', $user->id)->with('success', 'User exit successfully');
    }
}
