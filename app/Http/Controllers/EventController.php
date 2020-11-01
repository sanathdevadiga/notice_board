<?php

namespace App\Http\Controllers;

use App\Event;
use App\Staff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function isRole(){
        $r=Cache::get('role');
        if ((int)$r ==3)
        {
            return true;
        }
        else
            return false;
    }

    public function index()
    {
        if (!$this->isRole())
            return redirect()->back();
        return view('events.index');
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!$this->isRole())
            return redirect()->back();
        $event=$request->all();
        $imageName = time().'.'.$request->image->getClientOriginalExtension();
        $request->image->move(public_path('/image'), $imageName);
        $event['image']=$imageName;
        Event::create($event);
        return redirect()->route('events.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function show(Event $event)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function edit(Event $event)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Event $event)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function destroy(Event $event)
    {
        //
    }

    public function getevents(){
        $events=Event::all();
        return $events;
    }

    public function deleteevents(){
        $date=date("Y-m-d");
        $result=DB::select('delete from events where date<?',[$date]);
    
        echo json_encode($result);
    }
}
