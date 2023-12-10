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

        $records = Record::query();

        $records = $records->whereHas('user', function ($query) use ($name, $user) {
            $query->where('name', 'like', '%' . $name . '%');
            $query->where('company_id', $user->company->id);
        })->with('user')->get();

        $list = [];
        foreach ($records as $record) {

            $guard = User::findOrFail($record->guard_id);

            $list[] = [
                'id' => $record->id,
                'guard' => $guard->name,
                'user' => $record->user,
                'in' => $record->in === null ? "" :  Carbon::createFromFormat('Y-m-d H:i:s', $record->in)->tz('Asia/Manila')->format('F j, Y g:i a'),
                'out' => $record->out === null ? "" :  Carbon::createFromFormat('Y-m-d H:i:s', $record->out)->tz('Asia/Manila')->format('F j, Y g:i a')
            ];
        }

        return view('record.record', [
            'records' => $list,
            'name'  => $name
        ]);
    }
}
