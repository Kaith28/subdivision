<?php

namespace App\Http\Controllers;

use App\Models\Guest;
use App\Models\Record;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        $totalResidents = User::where('role', 'resident')->where('company_id', $user->company->id)->count();
        $totalInResidents = User::where('role', 'resident')->where('company_id', $user->company->id)->where('status', 'in')->count();
        $totalInTricycleDrivers = User::where('role', 'driver')->where('company_id', $user->company->id)->where('status', 'in')->count();
        $totalInGuests = Guest::where('out', null)->count(); // TODO

        $totalOutResidents = User::where('role', 'resident')->where('company_id', $user->company->id)->where('status', 'out')->count();
        $totalOutTricycleDrivers = User::where('role', 'driver')->where('company_id', $user->company->id)->where('status', 'out')->count();
        $totalOutGuests = Guest::where('out', '!=', null)->count();

        return view('dashboard', [
            'totalResidents' => $totalResidents,
            'totalIn' => $totalInResidents + $totalInTricycleDrivers,
            'totalOut' => $totalOutResidents + $totalOutTricycleDrivers,
            'totalInGuests' => $totalInGuests,
            'totalOutGuests' => $totalOutGuests,
        ]);
    }
}
