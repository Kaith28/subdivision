<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AnnouncementController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        $title = $request->input('title');

        $company = $user->company;

        $announcements = Announcement::query();

        if ($title !== null) {
            $announcements->where('title', 'LIKE', '%' . $title . '%');
        }

        $announcements->where('company_id', $user->company->id);
        $announcements = $announcements->get();

        $list = [];
        foreach ($announcements as $announcement) {
            $list[] = [
                'id' => $announcement->id,
                'slug' => $company->slug,
                'cover_photo' => $announcement->cover_photo,
                'title' => $announcement->title,
                'body' => $announcement->body,
                'created_at' => Carbon::createFromFormat('Y-m-d H:i:s', $announcement->created_at)->tz('Asia/Manila')->format('F j, Y g:i a'),
            ];
        }

        return view('announcement.announcement', [
            'announcements' => $list,
            "title" => $title
        ]);
    }

    public function create(Request $request)
    {
        $user = $request->user();
        return view('announcement.create');
    }

    public function store(Request $request)
    {
        $user = $request->user();

        $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'body' => ['required', 'string',],
        ]);

        if ($request->hasFile('photo')) {
            $image = $request->file('photo');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);

            $imagePath = '/images/' . $imageName;

            Announcement::create([
                'company_id' => $user->company->id,
                'cover_photo' => $imagePath,
                'title' => $request->title,
                'body' => $request->body,
            ]);
        }

        return redirect()->route('announcement');
    }



    public function show(Request $request)
    {
        $user = $request->user();

        return view('announcement.show');
    }



    public function edit(Request $request)
    {
        $user = $request->user();

        return view('announcement.edit');
    }


    public function update(Request $request)
    {
        $user = $request->user();

        return view('announcement.update');
    }

    public function destroy(Request $request)
    {
        $user = $request->user();

        $announcement = Announcement::where([
            'company_id' => $user->company->id,
            'id' => $request->id
        ])->first();

        if ($announcement === null) {
            abort(404);
        }

        $announcement->delete();

        return redirect()->route('announcement')->with('success', 'Announcement deleted successfully');
    }
}
