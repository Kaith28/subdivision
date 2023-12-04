<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\Guest;
use Carbon\Carbon;
use Illuminate\Http\Request;

class GuestController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        $name = $request->input('name');

        $guests = Guest::query();

        if ($name !== null) {
            $guests->where('name', 'LIKE', '%' . $name . '%');
        }

        $guests->where('company_id', $user->company->id);

        $guests = $guests->with('user')->get();

        $list = [];
        foreach ($guests as $guest) {
            $list[] = [
                'id' => $guest->id,
                'name' => $guest->name,
                'contact_no' => $guest->contact_no,
                'user' => $guest->user,
                'created_at' =>  Carbon::createFromFormat('Y-m-d H:i:s', $guest->created_at)->tz('Asia/Manila')->format('F j, Y g:i a'),
                'out' => $guest->out === null ? "" :  Carbon::createFromFormat('Y-m-d H:i:s', $guest->out)->tz('Asia/Manila')->format('F j, Y g:i a')
            ];
        }

        return view('guest.guest', [
            'guests' => $list,
            'name'  => $name
        ]);
    }
    public function show(Request $request)
    {
        $user = Guest::with('user')->findOrFail($request->id);

        $user->created_at = Carbon::createFromFormat('Y-m-d H:i:s', $user->created_at)->tz('Asia/Manila');

        return view('guest.show')->with('user', $user);
    }

    public function out(Request $request)
    {
        $user = Guest::findOrFail($request->id);
        $user->out = date("Y-m-d H:i:s");
        $user->save();
        return redirect()->route('guest', $user->id)->with('success', 'Guest out successfully');
    }
}
