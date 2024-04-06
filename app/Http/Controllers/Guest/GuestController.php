<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\Guest;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class GuestController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        $name = $request->input('name');
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $guests = Guest::query();

        if ($startDate !== null && $endDate !== null) {
            $guests->orWhereBetween('created_at', [Carbon::parse($startDate), Carbon::parse($endDate)])
                ->orWhereBetween('out', [Carbon::parse($startDate), Carbon::parse($endDate)]);
        }

        if ($name !== null) {
            $guests->where('name', 'LIKE', '%' . $name . '%');
        }

        $guests->where('company_id', $user->company->id);

        $guests = $guests->with('user')->with('user')->orderBy('created_at', 'desc') // Replace 'column_name' with the actual column name you want to sort by
            ->paginate(15);

        $list = [];
        foreach ($guests as $guest) {

            $guard = User::findOrFail($guest->in_charge_id);

            $list[] = [
                'id' => $guest->id,
                'guard' => $guard->name,
                'name' => $guest->name,
                'contact_no' => $guest->contact_no,
                'user' => $guest->user,
                'created_at' => Carbon::createFromFormat('Y-m-d H:i:s', $guest->created_at)->tz('Asia/Manila')->format('F j, Y g:i a'),
                'out' => $guest->out === null ? "" :  Carbon::createFromFormat('Y-m-d H:i:s', $guest->out)->tz('Asia/Manila')->format('F j, Y g:i a')
            ];
        }

        return view('guest.guest', [
            'guests' => $guests,
            'list' => $list,
            'name' => $name,
            'startDate' => $startDate,
            'endDate' => $endDate,
        ]);
    }
    public function show(Request $request)
    {
        $user = $request->user();

        $existingUser = Guest::with('user')->findOrFail($request->id);

        if ($user->company->id !== $existingUser->company->id) {
            abort(404);
        }

        $existingUser->created_at = Carbon::createFromFormat('Y-m-d H:i:s', $existingUser->created_at)->tz('Asia/Manila');

        return view('guest.show')->with('user', $existingUser);
    }

    public function out(Request $request)
    {
        $user = $request->user();

        $existingUser = Guest::findOrFail($request->id);

        if ($user->company->id !== $existingUser->company->id) {
            abort(404);
        }

        $existingUser->out = date("Y-m-d H:i:s");
        $existingUser->save();
        return redirect()->route('guest', $existingUser->id)->with('success', 'Guest out successfully');
    }
}
