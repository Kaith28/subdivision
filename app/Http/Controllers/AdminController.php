<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        $name = $request->input('name');

        $users = User::query();

        if ($name !== null) {
            $users->where('name', 'LIKE', '%' . $name . '%');
        }

        $users->where('role', 'admin');
        $users->where('is_deleted', false);
        $users->where('company_id', $user->company->id);

        $users = $users->with('company')->get();

        return view('admin.admin', [
            'users' => $users,
            'name'  => $name
        ]);
    }

    public function create(Request $request)
    {
        $user = $request->user();

        // Validation - check if subscription is active
        if (!$user->company->isActive()) {
            return redirect()->route('admin')->with('error', 'Subscription already expired');
        }

        return view('admin.create');
    }

    public function store(Request $request)
    {
        $user = $request->user();

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'contact_no' => ['required', 'string', 'max:255'],

            /* 'photo' => ['required', 'string'], */
        ]);

        if ($request->hasFile('photo')) {
            $image = $request->file('photo');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);

            $imagePath = '/images/' . $imageName;

            User::create([
                'company_id' => $user->company->id,
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'contact_no' => $request->contact_no,
                'subdivision' => $request->subdivision,
                'photo' => $imagePath,
                'role' => 'admin',
            ]);
        }


        return redirect()->route('admin');
    }

    public function show(Request $request)
    {
        $user = $request->user();

        $existingUser = User::findOrFail($request->id);

        if ($user->company->id !== $existingUser->company->id) {
            abort(404);
        }

        return view('admin.show')->with('user', $existingUser);
    }

    public function edit(Request $request)
    {
        $user = $request->user();

        $existingUser = User::findOrFail($request->id);

        if ($user->company->id !== $existingUser->company->id) {
            abort(404);
        }

        return view('admin.edit')
            ->with('user', $existingUser);
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'max:255'],
            'contact_no' => ['required', 'string', 'max:255'],
            'subdivision' => ['required', 'string', 'max:255'],

        ]);

        $user = $request->user();

        $existingUser = User::findOrFail($request->id);

        if ($user->company->id !== $existingUser->company->id) {
            abort(404);
        }

        $existingUser->name = $request->name;
        $existingUser->email = $request->email;
        $existingUser->contact_no = $request->contact_no;
        $existingUser->subdivision = $request->subdivision;
        $existingUser->photo = $request->photo;
        $existingUser->save();

        return redirect()->route('admin')->with('success', 'Updated user successfully');
    }

    public function destroy(Request $request)
    {

        $user = $request->user();

        $existingUser = User::findOrFail($request->id);

        if ($user->company->id !== $existingUser->company->id) {
            abort(404);
        }

        $existingUser->is_deleted = true;

        $existingUser->save();

        return redirect()->route('admin', $user->id)->with('success', 'Admin disable successfully');
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
