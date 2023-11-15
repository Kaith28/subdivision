<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\Guest;
use Illuminate\Http\Request;

class GuestController extends Controller
{
    public function index(Request $request)
    {
        $name = $request->input('name');

        $guests = Guest::query();

        if ($name !== null) {
            $guests->where('name', 'LIKE', '%' . $name . '%');
        }

        $guests = $guests->with('user')->get();

        return view('guest.guest', [
            'guests' => $guests,
            'name'  => $name
        ]);
    }
    public function show(Request $request)
    {
        $user = Guest::findOrFail($request->id);
        return view('guest.show')->with('user', $user);
    }
}
