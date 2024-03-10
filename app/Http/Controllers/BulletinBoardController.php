<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;

class BulletinBoardController extends Controller
{
    public function index(Request $request)
    {
        $slug = $request->slug;

        $company = Company::where('slug', $slug)->first();

        if ($company === null) {
            abort(404);
        }

        // 
        return view('bulletin-board.bulletin-board');
    }
}
