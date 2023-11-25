<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class GuardController extends Controller
{
    public function index(Request $request)
    {
        $name = $request->input('name');

        $users = User::query();

        if ($name !== null) {
            $users->where('name', 'LIKE', '%' . $name . '%');
        }

        $users->where('role', 'guard');

        $users = $users->get();

        return view('guard.guard', [
            'users' => $users,
            'name'  => $name
        ]);
    }
    public function create()
    {
        return view('guard.create');
    }

    public function store(Request $request)
    {
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
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'contact_no' => $request->contact_no,
                'photo' => $imagePath,
                'role' => 'guard',
            ]);
        }

        return redirect()->route('guard');
    }

    public function show(Request $request)
    {
        $user = user::findOrFail($request->id);
        return view('guard.show')->with('user', $user);
    }

    public function edit(Request $request)
    {
        $user = User::findOrFail($request->id);
        return view('guard.edit')
            ->with('user', $user);
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'max:255'],
            'contact_no' => ['required', 'string', 'max:255'],
            /* 'photo' => ['required', 'string'], */
        ]);

        $user = User::findOrFail($request->id);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->contact_no = $request->contact_no;

        $user->save();

        return redirect()->route('guard')->with('success', 'Updated user successfully');
    }
    public function destroy(Request $request)
    {
        $user = User::findOrFail($request->id);
        $user->delete();
        return redirect()->route('guard', $user->id)->with('success', 'User deleted successfully');
    }
    public function showAddGuestForm()
    {
        return view('guard.add_guest_form');
    }

    public function storeGuest(Request $request)
    {
        // Validate the form data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
        ]);

        // Process and store guest information (you can save it to the database, etc.)
        // For now, let's just print the data
        dd($validatedData);
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

            return redirect()->back()->with('success', 'Updated successfully');
        }
    }
}
