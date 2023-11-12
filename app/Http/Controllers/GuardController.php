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

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'contact_no' => $request->contact_no,
            'role' => 'guard',
        ]);

        return redirect()->route('guard');
    }

    public function show(Request $request)
    {
        $user = user::findOrFail($request->id);
        return view('guard.show')->with('guard', $user);
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
            /* 'contact_no' => ['required', 'string', 'max:255'], */
            'role' => ['required', 'string'],
            /* 'photo' => ['required', 'string'], */
        ]);

        $user = User::findOrFail($request->id);

        $user->name = $request->name;
        $user->contact_no = $request->contact_no;
        $user->role = $request->role;
        $user->save();

        return redirect()->route('guard')->with('success', 'Updated user successfully');
    }
}
