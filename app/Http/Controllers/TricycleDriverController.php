<?php

namespace App\Http\Controllers;

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
}
