<?php

namespace App\Http\Controllers;

use App\Models\Record;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TricycleDriverController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();
        $name = $request->input('name');

        $users = User::query();

        if ($name !== null) {
            $users->where('name', 'LIKE', '%' . $name . '%');
        }

        $users->where('role', 'driver');
        $users->where('is_deleted', false);
        $users->where('company_id', $user->company->id);

        $users = $users->get();

        return view('tricycledriver.tricycledriver', [
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
        return view('tricycledriver.create');
    }

    public function store(Request $request)
    {
        $user = $request->user();

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'contact_no' => ['required', 'string', 'max:255'],
            'plate_no' => ['required', 'string', 'max:255'],
            'photo' => ['required', 'string'],
        ]);
        $imageData = $request->input('photo');
        $decodedImage = base64_decode(preg_replace('/^data:image\/(png|jpeg|jpg);base64,/', '', $imageData));
        $imageName = $request->name . Str::random(20) . '.png';
        file_put_contents(public_path('images/' . $imageName), $decodedImage);
        $imagePath = '/images/' . $imageName;

        User::create([
            'company_id' => $user->company->id,
            'in_charge_id' => $user->id,
            'name' => $request->name,
            'contact_no' => $request->contact_no,
            'plate_no' => $request->plate_no,
            'photo' => $imagePath,
            'role' => 'driver',
        ]);


        return redirect()->route('tricycledriver');
    }

    public function show(Request $request)
    {
        $user = $request->user();

        // Validation - check if subscription is active
        if (!$user->company->isActive()) {
            return redirect()->route('tricycledriver')->with('error', 'Subscription already expired');
        }

        $existingUser = User::findOrFail($request->id);

        if ($user->company->id !== $existingUser->company->id) {
            abort(404);
        }

        return view('tricycledriver.show')->with('user', $existingUser);
    }

    public function edit(Request $request)
    {
        $user = $request->user();

        // Validation - check if subscription is active
        if (!$user->company->isActive()) {
            return redirect()->route('tricycledriver')->with('error', 'Subscription already expired');
        }

        $existingUser = User::findOrFail($request->id);

        if ($user->company->id !== $existingUser->company->id) {
            abort(404);
        }

        return view('tricycledriver.edit')
            ->with('user', $existingUser);
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'contact_no' => ['required', 'string', 'max:255'],
            'plate_no' => ['required', 'string', 'max:255'],
            'photo' => ['required', 'string'],
        ]);

        $user = $request->user();

        $existingUser = User::findOrFail($request->id);

        if ($user->company->id !== $existingUser->company->id) {
            abort(404);
        }

        $existingUser->name = $request->name;
        $existingUser->contact_no = $request->contact_no;
        $existingUser->plate_no = $request->plate_no;
        $existingUser->save();

        return redirect()->route('tricycledriver')->with('success', 'Updated user successfully');
    }

    public function destroy(Request $request)
    {
        $user = $request->user();

        // Validation - check if subscription is active
        if (!$user->company->isActive()) {
            return redirect()->route('tricycledriver')->with('error', 'Subscription already expired');
        }

        $existingUser = User::findOrFail($request->id);

        if ($user->company->id !== $existingUser->company->id) {
            abort(404);
        }

        $existingUser->delete();
        return redirect()->route('tricycledriver', $existingUser->id)->with('success', 'User deleted successfully');
    }

    public function enter(Request $request)
    {
        $user = $request->user();

        // Validation - check if subscription is active
        if (!$user->company->isActive()) {
            return redirect()->route('tricycledriver')->with('error', 'Subscription already expired');
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
                'company_id' => $user->company->id,
                'user_id' => $existingUser->id,
                'in_charge_id' => $user->id,
                'in' => date("Y-m-d H:i:s")
            ]);
        } else {
            $record->in = date("Y-m-d H:i:s");
            $record->save();
        }
        return redirect()->route('tricycledriver', $existingUser->id)->with('success', 'User enter successfully');
    }

    public function exit(Request $request)
    {
        $user = $request->user();

        // Validation - check if subscription is active
        if (!$user->company->isActive()) {
            return redirect()->route('tricycledriver')->with('error', 'Subscription already expired');
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
                'company_id' => $user->company->id,
                'user_id' => $existingUser->id,
                'in_charge_id' => $user->id,
                'out' => date("Y-m-d H:i:s")
            ]);
        } else {
            $record->out = date("Y-m-d H:i:s");
            $record->save();
        }
        return redirect()->route('tricycledriver', $existingUser->id)->with('success', 'User exit successfully');
    }

    public function changePhoto(Request $request)
    {
        $user = $request->user();

        // Validation - check if subscription is active
        if (!$user->company->isActive()) {
            return redirect()->route('tricycledriver')->with('error', 'Subscription already expired');
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
