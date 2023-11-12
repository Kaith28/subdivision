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
        $name = $request->input('name');

        $users = User::query();

        if ($name !== null) {
            $users->where('name', 'LIKE', '%' . $name . '%');
        }

        $users->where('role', 'admin');

        $users = $users->get();

        return view('admin.admin', [
            'users' => $users,
            'name'  => $name
        ]);
    }

    public function create()
    {
        return view('admin.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'contact_no' => ['required', 'string', 'max:255'],
            'photo' => ['required', 'string'],
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'contact_no' => $request->contact_no,
            'role' => 'admin',
        ]);

        return redirect()->route('admin');
    }

    public function show(Request $request)
    {
        $user = user::findOrFail($request->id);
        return view('admin.show')->with('admin', $user);
    }

    public function edit(Request $request)
    {
        $user = User::findOrFail($request->id);
        return view('admin.edit')
            ->with('user', $user);
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'max:255'],
            'contact_no' => ['required', 'string', 'max:255'],

        ]);

        $user = User::findOrFail($request->id);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->contact_no = $request->contact_no;

        $user->save();

        return redirect()->route('admin')->with('success', 'Updated user successfully');
    }
}
