<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class RelativesController extends Controller
{
    public function create()
    {
        $name = $request->input('name');

        $users = User::query();

        if ($name !== null) {
            $users->where('name', 'LIKE', '%' . $name . '%');
        }

        $users->where('role', 'relatives');

        $users = $users->get();

        return view('relatives.relatives', [
            'relatives' => $relatives,
            'name'  => $name
        ]);
    }
}