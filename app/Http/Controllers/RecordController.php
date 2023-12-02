<?php

namespace App\Http\Controllers;

use App\Models\Record;
use Carbon\Carbon;
use Illuminate\Http\Request;

class RecordController extends Controller
{
    public function index(Request $request)
    {
        $name = $request->input('name');

        $records = Record::query();

        $records = $records->whereHas('user', function ($query) use ($name) {
            $query->where('name', 'like', '%' . $name . '%');
        })->with('user')->get();

        $list = [];
        foreach ($records as $record) {
            $list[] = [
                'id' => $record->id,
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
