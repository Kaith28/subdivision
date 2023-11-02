<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class UserController extends Controller
{

    public function index(Request $request)
    {
        $name = $request->input('name');
        $role = $request->input('role');

        $users = User::query();

        if ($name !== null) {
            $users->where('name', 'LIKE', '%' . $name . '%');
        }

        if ($role !== null) {
            $users->where('role', $role);
        }

        $users = $users->get();

        return view('users.users', [
            'users' => $users,
            'name' => $name,
            'role' => $role
        ]);
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'contact_no' => ['required', 'string', 'max:255'],
            'role' => ['required', 'string'],
            /* 'photo' => ['required', 'string'], */
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            /* 'contact_no' => $request->contact_no, */
            'role' => $request->role,
        ]);

        return redirect()->route('users');
    }

    public function show(Request $request)
    {
        $user = user::findOrFail($request->id);
        return view('users.show')->with('user', $user);
    }

    public function edit(Request $request)
    {
        $user = User::findOrFail($request->id);
        return view('users.edit')
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
        /* $user->contact_no = $request->contact_no; */
        $user->role = $request->role;
        $user->save();

        return redirect()->route('users')->with('success', 'Updated user successfully');
    }

    public function destroy(Request $request)
    {
        $user = User::findOrFail($request->id);
        $user->delete();
        return redirect()->route('users', $user->id)->with('success', 'User deleted successfully');
    }
}
