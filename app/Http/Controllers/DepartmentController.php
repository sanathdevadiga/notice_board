<?php

namespace App\Http\Controllers;

use App\_Class;
use App\Department;
use App\Staff;
use App\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function isRole(){
        $r=Cache::get('role');
        if ((int)$r ==1 || (int)$r ==3)
        {
            return true;
        }
        else
            return false;
    }

    public function isAdmin(){
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
        if (!$this->isAdmin())
            return redirect()->back();
        $depts=Department::all();
        return view('departments.index',compact('depts'));
    }

    public function showclass(){
        if (!$this->isAdmin())
            return redirect()->back();
        $staffs=Staff::all();
        $details=DB::select("select c.id,d.dept,d.sem,d.sec,s.name,sub.subname from departments d,staff s,subjects sub,classes c where c.subject_id= sub.id and c.department_id=d.id and c.staff_id=s.id");
        return view('admin.index',compact('details','staffs'));

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
        if (!$this->isAdmin())
            return redirect()->back();

        $res=Department::where('dept',$request->dept)->where('sem',$request->sem)->where('sec',$request->sec)->get();
        if(count($res)==0){
            $result=$request->all();
            Department::create($result);
    
        }
        
        return redirect()->route('departments.index');

    }
    public function getalldept()
    {
        if (!$this->isRole())
            return redirect()->back();
        $dept=DB::select('select distinct dept from departments');
        return json_encode($dept);
    }

    public function getallsem(Request $request)

    {
        if (!$this->isRole())
            return redirect()->back();
        $sem=Department::where('dept',$request->dept)->select('sem')->distinct()->get();
        return json_encode($sem);

    }
    public function getallsec(Request $request)

    {
        if (!$this->isRole())
            return redirect()->back();
        $sec=Department::where('dept',$request->dept)->where('sem',$request->sem)->select('sec')->distinct()->get();
        return json_encode($sec);

    }

    public function addclass(Request $request){
        if (!$this->isAdmin())
            return redirect()->back();
        $department_id=Department::where('dept',$request->dept)->where('sem',$request->sem)->where('sec',$request->sec)->get()[0]->id;
        $staff_id=Staff::where('name',$request->staff)->get()[0]->id;
        $subject_id=Subject::where('subname',$request->subject)->get()[0]->id;
        $class_id=DB::select('select id from classes where subject_id=? and department_id=?',[$subject_id,$department_id]);
        if(count($class_id)>0){
            return redirect()->route('events.index');
        }
        $class['department_id']=$department_id;
        $class['subject_id']=$subject_id;
        $class['staff_id']=$staff_id;
        _Class::create($class);
        return redirect()->route('events.index');
    }

    public function editclass(Request $request){
        if (!$this->isAdmin())
            return redirect()->back();
        $staff_id=Staff::where('name',$request->name)->get()[0]->id;
        DB::select('update classes set staff_id=? where id=?',[$staff_id,$request->id]);
        return redirect()->route('events.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function show(Department $department)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function edit(Department $department)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Department $department)
    {
        //
    }

    public function deletedepts(Request $request)
    {
        if (!$this->isAdmin())
            return redirect()->back();
        $res=_Class::where('department_id',$request->id)->get();
        if (count($res)==0) {
            Department::where('id', $request->id)->delete();
            return 1;
        }
        else
            return -1;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function destroy(Department $department)
    {

    }
}
