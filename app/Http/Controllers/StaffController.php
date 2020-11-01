<?php

namespace App\Http\Controllers;

use App\_Class;
use App\Role;
use App\Staff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;


class StaffController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     * 

     
     */

    public function isRole(){
        $r=Cache::get('role');
        if ((int)$r ==1)
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
        $staffs=Staff::all();
        $roles=Role::all();
        return view('staffs.index',compact('staffs','roles'));
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

        $res=Staff::where('ssn',$request->ssn)->get();
        if(count($res)==0){
            $role_id=Role::where('permission',$request->role)->get()[0]->id;
            $staff=$request->all();
            $staff['role_id']=$role_id;
            Staff::create($staff);
        }
       
        return redirect()->route('staffs.index');
    }

    public function getstaff(){
        if (!$this->isRole())
            return redirect()->back();
        $staff=Staff::all();
        return json_encode($staff);
    }

    public function deletestaff(Request $request)
    {
        if (!$this->isRole())
            return redirect()->back();

        $staff_id=Session::get('id');
        
        if($request->id==$staff_id){
            return -1;
        }

        $res=_Class::where('staff_id',$request->id)->get();
        if (count($res)==0) {
            Staff::where('id', $request->id)->delete();
            return 1;
        }
        else
            return -3;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Staff  $staff
     * @return \Illuminate\Http\Response
     */
    public function show(Staff $staff)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Staff  $staff
     * @return \Illuminate\Http\Response
     */
    public function edit(Staff $staff)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Staff  $staff
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Staff $staff)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Staff  $staff
     * @return \Illuminate\Http\Response
     */
    public function destroy(Staff $staff)
    {
        //
    }
}
