<?php

namespace App\Http\Controllers;

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
            'name' => ['required', 'string', 'max:255'],
            'contact_no' => ['required', 'string', 'max:255'],
            'plate_no' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
            /* 'photo' => ['required', 'string'], */
        ]);

        User::create([
            'name' => $request->name,
            'contact_no' => $request->contact_no,
            'plate_no' => $request->plate_no,
            'address' => $request->address,
            'role' => 'resident',
        ]);

        return redirect()->route('resident');
    }
}
