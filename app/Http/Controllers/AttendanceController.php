<?php

namespace App\Http\Controllers;

use App\_Class;
use App\Attendance;
use App\Department;
use App\NoClass;
use App\Student;
use App\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use mysql_xdevapi\Session;
use function MongoDB\BSON\toJSON;

class AttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function isRole(){
        $r=Cache::get('role');
        if ((int)$r ==2)
        {
            return true;
        }
        else
            return false;
    }

    public function index()
    {
        if (!($this->isRole()))
            return redirect()->back();
        return view('attendances.index');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!$this->isRole())
            return redirect()->back();
        $students=Student::all();
        $depts=Department::all();
        return view('attendances.create',compact('students','depts'));
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
        $subject_id= \session('subject_id')   ;
        $department_id=\session('department_id');
        $staff_id= \Illuminate\Support\Facades\Session::get('id');
        $no_class=_Class::where('department_id',$department_id)->where('subject_id',$subject_id)->where('staff_id',$staff_id)->get();
       // dd($no_class);
        if(count($no_class)==0)
        {
            $c=1;
            _Class::create(['department_id'=>$department_id,'subject_id'=>$subject_id,'staff_id'=>$staff_id,'no_class'=>1]);
        }
        else
        {
            $c=$no_class[0]->no_class+1;
            $class=_Class::find($no_class[0]->id);
            $class->update(['department_id'=>$department_id,'subject_id'=>$subject_id,'staff_id'=>$staff_id,'no_class'=>$c]);

        }
        $ids=$request->all();
        array_shift($ids);
        $attend=['subject_id'=>$subject_id];
        foreach ($ids as $id){
         $attend['student_id']=$id;
         Attendance::create($attend);
        }
       return redirect()->route('attendances.index');
    }


    public function putattendances(Request $request)
    {
        if (!$this->isRole())
            return redirect()->back();
        $subject_id=Subject::where('subname',$request->subname)->get()[0]->id;
        \session(['subject_id'=>$subject_id]);
        $dept=Department::where('dept',$request->dept)->where('sem',$request->sem)->where('sec',$request->sec)->select('id')->get()[0]->id;
        \session(['department_id'=>$dept]);
        $students=Student::where('department_id',$dept)->get();
        return json_encode($students);
    }
    public function getattendances(Request $request)

    {
        if (!$this->isRole())
            return redirect()->back();
        $dept=Department::where('dept',$request->dept)->where('sem',$request->sem)->where('sec',$request->sec)->select('id')->get()[0]->id;
        $subject_id=Subject::where('subname',$request->subname)->get()[0]->id;
        $staff_id= \Illuminate\Support\Facades\Session::get('id')   ;
        $result=_Class::where('department_id',$dept)->where('subject_id',$subject_id)->where('staff_id',$staff_id)->get()[0];
        $no_class=$result->no_class;
        $subject_id=$result->subject_id;
        $department_id=$result->department_id;
        $students=DB::select('select s.id,s.name,s.usn,count(a.student_id)/? as count from students s,attendances a,subjects sub where s.id=a.student_id and sub.id=a.subject_id and sub.id=? and s.department_id=? group by s.id,s.name,s.usn',[$no_class,$subject_id,$department_id]);
        return json_encode($students);

    }



    /**
     * Display the specified resource.
     *
     * @param  \App\Attendance  $attendance
     * @return \Illuminate\Http\Response
     */
    public function show(Attendance $attendance)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Attendance  $attendance
     * @return \Illuminate\Http\Response
     */
    public function edit(Attendance $attendance)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Attendance  $attendance
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Attendance $attendance)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Attendance  $attendance
     * @return \Illuminate\Http\Response
     */
    public function destroy(Attendance $attendance)
    {
        //
    }
}
