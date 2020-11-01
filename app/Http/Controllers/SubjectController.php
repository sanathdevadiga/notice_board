<?php

namespace App\Http\Controllers;

use App\_Class;
use App\Department;
use App\Student;
use App\Subject;
use App\Staff;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
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
        $subjects=Subject::all();
        return view('subjects.index',compact('subjects'));
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

    public function getsubject(){
        $subject=Subject::all();
        return json_encode($subject);
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

        $res=Subject::where('subcode',$request->subcode)->get();
        if(count($res)==0){
            $subject=$request->all();
            Subject::create($subject);
            
        }
        return redirect()->route('subjects.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function show(Subject $subject)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function edit(Subject $subject)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Subject $subject)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subject $subject,$id)
    {
       
    }

  


    public function deletesubject(Request $request)
    {
        if(!$this->isRole()){
            return redirect()->back();
        }
        else {
            $res=DB::select('select sub.id from classes c,subjects sub where c.subject_id=sub.id');
            if(count($res)==0){
                Subject::destroy($request->id);
                return 1;
            }
            return -1;
        }
    }
}
