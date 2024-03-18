<?php

namespace App\Http\Controllers;

use App\Models\Record;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class RecordController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();
        $name = $request->input('name');
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $records = Record::query();

        if ($startDate !== null && $endDate !== null) {
            $records->orWhereBetween('in', [Carbon::parse($startDate), Carbon::parse($endDate)])
                ->orWhereBetween('out', [Carbon::parse($startDate), Carbon::parse($endDate)]);
        }

        $records = $records->whereHas('user', function ($query) use ($name, $user) {
            $query->where('name', 'like', '%' . $name . '%');
            $query->where('company_id', $user->company->id);
        })->with('user')->orderBy('in', 'desc') // Replace 'column_name' with the actual column name you want to sort by
            ->paginate(15);

        $list = [];
        foreach ($records as $record) {

            $guard = User::findOrFail($record->in_charge_id);

            $list[] = [
                'id' => $record->id,
                'guard' => $guard->name,
                'user' => $record->user,
                'in' => $record->in === null ? "" :  Carbon::createFromFormat('Y-m-d H:i:s', $record->in)->tz('Asia/Manila')->format('F j, Y g:i a'),
                'out' => $record->out === null ? "" :  Carbon::createFromFormat('Y-m-d H:i:s', $record->out)->tz('Asia/Manila')->format('F j, Y g:i a')
            ];
        }

        return view('record.record', [
            'records' => $records,
            'list' => $list,
            'name' => $name,
            'startDate' => $startDate,
            'endDate' => $endDate,
        ]);
    }
}
