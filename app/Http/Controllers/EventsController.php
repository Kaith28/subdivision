<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EventsController extends Controller
{

    public function index(Request $request)
    {
        $user = $request->user();
    }





    public function create(Request $request)
    {
        $user = $request->user();
        return view('events.create');
    }




    public function store(Request $request)
    {
        $user = $request->user();
        return view('events.create');
    }




    public function show(Request $request)
    {
        $user = $request->user();
    }




    public function edit(Request $request)
    {
        $user = $request->user();
        return view('events.edit');
    }




    public function update(Request $request)
    {
        $user = $request->user();
        return view('events.update');
    }




    public function destroy(Request $request)
    {
        $user = $request->user();
        return view('events.destroy');
    }
}
