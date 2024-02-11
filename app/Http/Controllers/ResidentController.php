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
        $user = $request->user();
        $name = $request->input('name');

        $users = User::query();

        if ($name !== null) {
            $users->where('name', 'LIKE', '%' . $name . '%');
        }

        $users->where('role', 'resident');
        $users->where('is_deleted', false);
        $users->where('company_id', $user->company->id);

        $users = $users->get();

        return view('resident.resident', [
            'users' => $users,
            'name'  => $name
        ]);
    }
    public function create(Request $request)
    {
        $user = $request->user();

        // Validation - check if subscription is active
        if (!$user->company->isActive()) {
            return redirect()->route('resident')->with('error', 'Subscription already expired');
        }
        return view('resident.create');
    }

    public function store(Request $request)
    {
        $user = $request->user();

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
                'company_id' => $user->company->id,
                'in_charge_id' => $user->id,
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
        $user = $request->user();

        $existingUser = User::findOrFail($request->id);

        if ($user->company->id !== $existingUser->company->id) {
            abort(404);
        }

        return view('resident.show')->with('user', $existingUser);
    }

    public function edit(Request $request)
    {
        $user = $request->user();

        // Validation - check if subscription is active
        if (!$user->company->isActive()) {
            return redirect()->route('resident')->with('error', 'Subscription already expired');
        }

        $existingUser = User::findOrFail($request->id);

        if ($user->company->id !== $existingUser->company->id) {
            abort(404);
        }

        return view('resident.edit')
            ->with('user', $existingUser);
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

        $user = $request->user();

        $existingUser = User::findOrFail($request->id);

        if ($user->company->id !== $existingUser->company->id) {
            abort(404);
        }

        $existingUser->position = $request->position;
        $existingUser->name = $request->name;
        $existingUser->contact_no = $request->contact_no;
        $existingUser->vehicle_type = $request->vehicle_type;
        $existingUser->plate_no = $request->plate_no;
        $existingUser->address = $request->address;
        $existingUser->relatives = $request->relatives;
        $existingUser->save();

        return redirect()->route('resident')->with('success', 'Updated user successfully');
    }
    public function destroy(Request $request)
    {
        $user = $request->user();

        // Validation - check if subscription is active
        if (!$user->company->isActive()) {
            return redirect()->route('resident')->with('error', 'Subscription already expired');
        }

        $existingUser = User::findOrFail($request->id);

        if ($user->company->id !== $existingUser->company->id) {
            abort(404);
        }

        $existingUser->is_deleted = true;
        $existingUser->save();

        return redirect()->route('resident', $existingUser->id)->with('success', 'User deleted successfully');
    }

    public function createGuest(Request $request)
    {
        $user = $request->user();

        // Validation - check if subscription is active
        if (!$user->company->isActive()) {
            return redirect()->route('resident')->with('error', 'Subscription already expired');
        }

        return view('guest.create');
    }

    public function storeGuest(Request $request)
    {
        $user = $request->user();

        $existingUser = User::findOrFail($request->id);

        if ($user->company->id !== $existingUser->company->id) {
            abort(404);
        }

        if ($request->hasFile('photo')) {
            $image = $request->file('photo');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);

            $imagePath = '/images/' . $imageName;


            Guest::create([
                'company_id' => $existingUser->company->id,
                'in_charge_id' => $user->id,
                'user_id' => $existingUser->id,
                'name' => $request->name,
                'contact_no' => $request->contact_no,
                'photo' => $imagePath,

            ]);
        }
        return redirect()->route('guest');
    }

    public function enter(Request $request)
    {
        $user = $request->user();

        if (!$user->company->isActive()) {
            return redirect()->route('resident')->with('error', 'Subscription already expired');
        }

        $existingUser = User::findOrFail($request->id);

        if ($user->company->id !== $existingUser->company->id) {
            abort(404);
        }

        $existingUser->status = 'in';
        $existingUser->save();

        $record = $existingUser->records->where('in', null)->last();

        if ($record == null) {
            Record::create([
                'user_id' => $existingUser->id,
                'in_charge_id' => $user->id,
                'in' => date("Y-m-d H:i:s")
            ]);
        } else {
            $record->in = date("Y-m-d H:i:s");
            $record->save();
        }

        return redirect()->route('resident', $existingUser->id)->with('success', 'User enter successfully');
    }

    public function exit(Request $request)
    {
        $user = $request->user();

        if (!$user->company->isActive()) {
            return redirect()->route('resident')->with('error', 'Subscription already expired');
        }

        $existingUser = User::findOrFail($request->id);

        if ($user->company->id !== $existingUser->company->id) {
            abort(404);
        }

        $existingUser->status = 'out';
        $existingUser->save();

        $record = $existingUser->records->where('out', null)->last();

        if ($record == null) {
            Record::create([
                'user_id' => $existingUser->id,
                'in_charge_id' => $user->id,
                'out' => date("Y-m-d H:i:s")
            ]);
        } else {
            $record->out = date("Y-m-d H:i:s");
            $record->save();
        }

        return redirect()->route('resident', $existingUser->id)->with('success', 'User exit successfully');
    }

    public function changePhoto(Request $request)
    {

        $user = $request->user();

        if (!$user->company->isActive()) {
            return redirect()->route('resident')->with('error', 'Subscription already expired');
        }

        $existingUser = User::findOrFail($request->id);

        if ($user->company->id !== $existingUser->company->id) {
            abort(404);
        }

        if ($request->hasFile('photo')) {
            $image = $request->file('photo');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);

            $imagePath = '/images/' . $imageName;

            $existingUser->photo = $imagePath;
            $existingUser->save();

            return redirect()->back()->with('success', 'Updated photo successfully');
        }
    }
}
