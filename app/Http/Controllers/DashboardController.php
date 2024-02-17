<?php

namespace App\Http\Controllers;

use App\Models\Guest;
use App\Models\Record;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        $timePeriod = $request->input('time-period');

        $totalResidents = User::where('role', 'resident')->where('company_id', $user->company->id)->count();
        $totalTricycleDrivers = User::where('role', 'driver')->where('company_id', $user->company->id)->count();
        $totalInResidents = User::where('role', 'resident')->where('company_id', $user->company->id)->where('status', 'in')->count();
        $totalInTricycleDrivers = User::where('role', 'driver')->where('company_id', $user->company->id)->where('status', 'in')->count();
        $totalInGuests = Guest::where('out', null)->count(); // TODO

        $totalOutResidents = User::where('role', 'resident')->where('company_id', $user->company->id)->where('status', 'out')->count();
        $totalOutTricycleDrivers = User::where('role', 'driver')->where('company_id', $user->company->id)->where('status', 'out')->count();
        $totalOutGuests = Guest::where('out', '!=', null)->count();

        // weekly
        $startDate = Carbon::now()->startOfWeek();
        $endDate = Carbon::now()->endOfWeek();
        $format = "l"; // name of day

        // monthly
        if ($timePeriod == "monthly") {
            $startDate = Carbon::now()->startOfYear();
            $endDate = Carbon::now()->endOfYear();
            $format = "F"; // month name (jan, feb)
        }

        // yearly
        if ($timePeriod == "yearly") {
            $startDate = Carbon::now()->startOfYear()->subYear(3);
            $endDate = Carbon::now()->endOfYear();
            $format = "Y"; // 2024,
        }

        $dataIn = Record::whereBetween('in', [$startDate, $endDate])
            ->get()
            ->groupBy(function ($record) use ($format) {
                return Carbon::createFromFormat('Y-m-d H:i:s', $record->in)->tz('Asia/Manila')->format($format);
            });

        $dataOut = Record::whereBetween('out', [$startDate, $endDate])
            ->get()
            ->groupBy(function ($record) use ($format) {
                return Carbon::createFromFormat('Y-m-d H:i:s', $record->in)->tz('Asia/Manila')->format($format);
            });

        $dataOne = [];
        $dataTwo = [];

        foreach ($dataIn as $index => $items) {
            $dataOne[] = [
                'label' => $index,
                'y' => $items->count()
            ];
        }

        foreach ($dataOut as $index => $items) {
            $dataTwo[] = [
                'label' => $index,
                'y' => $items->count()
            ];
        }

        return view('dashboard', [
            'totalResidents' => $totalResidents,
            'totalTricycleDrivers' => $totalTricycleDrivers,
            'totalIn' => $totalInResidents + $totalInTricycleDrivers,
            'totalOut' => $totalOutResidents + $totalOutTricycleDrivers,
            'totalInGuests' => $totalInGuests,
            'totalOutGuests' => $totalOutGuests,
            'dataOne' => $dataOne,
            'dataTwo' => $dataTwo,
            'timePeriod' => $timePeriod
        ]);
    }
}
