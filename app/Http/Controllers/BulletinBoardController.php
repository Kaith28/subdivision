<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use App\Models\Company;
use Carbon\Carbon;
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

        $list = [];
        foreach ($company->announcements as $announcement) {
            $list[] = [
                'id' => $announcement->id,
                'slug' => $company->slug,
                'cover_photo' => $announcement->cover_photo,
                'title' => $announcement->title,
                'body' => $announcement->body,
                'created_at' => Carbon::createFromFormat('Y-m-d H:i:s', $announcement->created_at)->tz('Asia/Manila')->format('F j, Y g:i a'),
            ];
        }

        return view('bulletin-board.bulletin-board', [
            'announcements' => $list
        ]);
    }

    public function show(Request $request)
    {
        $slug = $request->slug;
        $id = $request->id;

        $company = Company::where('slug', $slug)->first();

        if ($company === null) {
            abort(404);
        }

        $announcement = Announcement::where([
            'company_id' => $company->id,
            'id' => $id
        ])->first();

        if ($announcement === null) {
            abort(404);
        }

        return view('bulletin-board.show', [
            'announcement' => [
                "cover_photo" => $announcement->cover_photo,
                "title" => $announcement->title,
                "body" => $announcement->body,
                "created_at" => Carbon::createFromFormat('Y-m-d H:i:s', $announcement->created_at)->tz('Asia/Manila')->format('F j, Y g:i a'),
            ]
        ]);
    }
}
