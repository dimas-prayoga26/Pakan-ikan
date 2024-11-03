<?php

namespace App\Http\Controllers;

use App\Models\FeedSchedules;

class FeedSchedulesController extends Controller
{
    public function index()
    {
        $feedSchedules = FeedSchedules::all();
        return view('admin.feedSchedules.index', compact('feedSchedules'));
    }

    public function edit($id)
    {
        $feedSchedules = FeedSchedules::findOrFail($id);

        // dd($feedSchedules);
        return view('admin.feedSchedules.edit', compact('feedSchedules'));
    }


    public function update($id)
    {
        $feedSchedules = FeedSchedules::findOrFail($id);

        $time1 = explode(':', request('time1'));
        $time2 = explode(':', request('time2'));
        $time3 = explode(':', request('time3'));

        $feedSchedules->hourOne = $time1[0];
        $feedSchedules->minuteOne = $time1[1];

        $feedSchedules->hourTwo = $time2[0];
        $feedSchedules->minuteTwo = $time2[1];

        $feedSchedules->hourThree = $time3[0];
        $feedSchedules->minuteThree = $time3[1];

        $feedSchedules->save();

        return redirect()->route('feedSchedules.index')->with('success', 'Feed Schedule updated successfully');
    }

}
