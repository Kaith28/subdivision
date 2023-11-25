<?php

namespace App\Http\Controllers;

use App\Models\Guest;
use App\Models\Record;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalResidents = User::where('role', 'resident')->count();
        $totalInResidents = User::where('role', 'resident')->where('status', 'in')->count();
        $totalInTricycleDrivers = User::where('role', 'driver')->where('status', 'in')->count();
        $totalInGuests = Guest::where('out', null)->count();

        $totalOutResidents = User::where('role', 'resident')->where('status', 'out')->count();
        $totalOutTricycleDrivers = User::where('role', 'driver')->where('status', 'out')->count();
        $totalOutGuests = Guest::where('out', '!=', null)->count();

        return view('dashboard', [
            'totalResidents' => $totalResidents,
            'totalIn' => $totalInResidents + $totalInGuests + $totalInTricycleDrivers,
            'totalOut' => $totalOutResidents + $totalOutGuests + $totalOutTricycleDrivers
        ]);
    }
}
