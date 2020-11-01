<?php

namespace App\Http\Controllers;

use App\_Class;
use App\Department;
use App\Mark;
use App\Student;
use App\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class MarkController extends Controller
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

    public function isRole1(){
        $r=Cache::get('role');
        if ((int)$r ==3)
        {
            return true;
        }
        else
            return false;
    }

    public function getdept()
    {
        if (!$this->isRole())
            return redirect()->back();
        $staff_id=Session::get('id')   ;
        $dept=DB::select('select distinct d.dept from departments d,classes c where c.staff_id=? and d.id=c.department_id',[$staff_id]);
        return json_encode($dept);
    }

    public function getsem(Request $request)
    {
        if (!$this->isRole())
            return redirect()->back();
        $dept=Department::where('dept',$request->dept)->select('id')->get();
        $staff_id=Session::get('id')   ;
        $d= _Class::where('staff_id',$staff_id)->whereIn('department_id',$dept)->select('department_id')->get();
        $sem=Department::whereIn('id',$d)->select('sem')->distinct()->get();
        return json_encode($sem);

    }
    public function getsec(Request $request)
    {
        if (!$this->isRole())
            return redirect()->back();
        $dept=Department::where('dept',$request->dept)->where('sem',$request->sem)->select('id')->get();
        $staff_id=Session::get('id')   ;
        $d=_Class::where('staff_id',$staff_id)->whereIn('department_id',$dept)->select('department_id')->get();
        $sec=Department::whereIn('id',$d)->select('sec')->distinct()->get();
        return json_encode($sec);

    }

    public function getstaffsubject(Request $request){
        if (!$this->isRole())
            return redirect()->back();
        $dept=Department::where('dept',$request->dept)->where('sem',$request->sem)->where('sec',$request->sec)->select('id')->get();
        $staff_id=Session::get('id')   ;
        $d=_Class::where('staff_id',$staff_id)->where('department_id',$dept[0]['id'])->select('subject_id')->get();
        $subject=Subject::whereIn('id',$d)->select('subname')->distinct()->get();
        return json_encode($subject);
    }

    
    public function getallsubject(Request $request){
        if (!$this->isRole1())
            return redirect()->back();
        $type=$request->type;
        $dept=Department::where('dept',$request->dept)->where('sem',$request->sem)->where('sec',$request->sec)->select('id')->get();
        // $staff_id=Session::get('id');
        if($type=='marks'){
            $subject=DB::select('select sub.id,sub.subname from subjects sub,classes c,marks m where sub.id=c.subject_id and m.subject_id=sub.id and c.department_id=? group by sub.subname,sub.id order by sub.id',[$dept]);
        }
        else if($type=='attendance'){
            $subject=DB::select('select sub.id,sub.subname from subjects sub,classes c,attendances a where sub.id=c.subject_id and a.subject_id=sub.id and c.department_id=? group by sub.subname,sub.id order by sub.id',[$dept]);
        }
        return json_encode($subject);
    }

    public function index()
    {
        if (!$this->isRole())
            return redirect()->back();
        return view('marks.index');
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
        $depts=Department::all();
        $students=Student::all();
        return view('marks.create',compact('depts','students'));
    }

    public function putmarks(Request $request)
    {
        if (!$this->isRole())
            return redirect()->back();
        $subject_id=Subject::where('subname',$request->subname)->get()[0]->id;
        \session(['subject_id'=>$subject_id]);
        $dept=Department::where('dept',$request->dept)->where('sem',$request->sem)->where('sec',$request->sec)->select('id')->get()[0]->id;
        \session(['internal'=>$request->internal]);
        $count=DB::select('select s.usn from students s,marks m where s.id=m.student_id and m.ia=? and s.department_id=? and subject_id=? limit 1',[$request->internal,$dept,$subject_id]);
        if(count($count)){
            $students=DB::select('select s.id,s.usn,s.name,m.mark from students s,marks m where s.id=m.student_id and m.ia=? and s.department_id=? and subject_id=?',[$request->internal,$dept,$subject_id]);
        }
        else{
            $students=Student::where('department_id',$dept)->select('id','usn','name')->get();
        }
        return json_encode($students);
    }

    public function getmarks(Request $request)
    {
        if (!$this->isRole())
            return redirect()->back();
        $staff_id=Session::get('id')   ;
        $subject_id=Subject::where('subname',$request->subname)->get()[0]->id;
        $department_id=Department::where('dept',$request->dept)->where('sem',$request->sem)->where('sec',$request->sec)->select('id')->get()[0]->id;
        $internal=(int)($request->internal);
        $students=DB::select('select s.id,s.name,s.usn,m.mark,m.subject_id from students s,marks m,subjects sub where s.id=m.student_id and sub.id=m.subject_id and sub.id=? and s.department_id=? and m.ia=?',[$subject_id,$department_id,$internal]);
//        if (count($students))
//            return json_encode($students);
//        else
//            return -1;
        return json_encode($students);
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
        $internal=\session('internal');
        $subject_id=\session('subject_id');
        $marks=$request->all();
        unset($marks['_token']);
        $m['subject_id']=$subject_id;
        $m['ia']=$internal;
        foreach ($marks as $key=>$val){
            $count=DB::select('select student_id from marks where ia=? and student_id=? and subject_id=? limit 1',[$internal,$key,$subject_id]);
            break;
        }
        if(count($count)){
            foreach ($marks as $key=>$val){
                Mark::where('student_id',$key)->where('ia',$internal)->where('subject_id',$subject_id)->update(['mark'=>$val]);
            }
        }
        else{
            foreach ($marks as $key=>$val){
                $m['student_id']=$key;
                $m['mark']=$val;
                Mark::create($m);
            }
        }
        return redirect()->route('marks.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Mark  $mark
     * @return \Illuminate\Http\Response
     */
    public function show(Mark $mark)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Mark  $mark
     * @return \Illuminate\Http\Response
     */
    public function edit(Mark $mark)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Mark  $mark
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Mark $mark)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Mark  $mark
     * @return \Illuminate\Http\Response
     */
    public function destroy(Mark $mark)
    {
        //
    }

    public function getallmarks(Request $request)
    {
        if (!$this->isRole1())
            return redirect()->back();
        // $staff_id=Session::get('id')  ;
        // $subject_id=Subject::where('subname',$request->subname)->get()[0]->id;
        $department_id=Department::where('dept',$request->dept)->where('sem',$request->sem)->where('sec',$request->sec)->select('id')->get()[0]->id;
        $internal=(int)($request->internal);
        // $students=DB::select('select s.id,s.name,s.usn,m.mark from students s,marks m,subjects sub where s.id=m.student_id and sub.id=m.subject_id and sub.id=? and s.department_id=? and m.ia=?',[$subject_id,$department_id,$internal]);
//        if (count($students))
//            return json_encode($students);
//        else
//            return -1;
        if($request->type=='marks'){
            $s=DB::select('select s.id,s.usn,s.name,m.mark,m.subject_id from students s inner join marks m on m.student_id=s.id where m.ia=? order by s.usn,m.subject_id',[$internal]);
        }
        else if($request->type=='attendance'){
            $s=DB::select("select s.id,s.usn,s.name,c.subject_id,count(a.student_id)/c.no_class*100 as percentage from students s,attendances a,classes c where s.id=a.student_id and c.subject_id=a.subject_id and s.department_id=? group by c.subject_id,a.subject_id,s.usn,s.name,c.no_class,s.id order by c.subject_id",[$department_id]);     
        }
        return json_encode($s);
    }

    public function getstudentsubject(Request $request){
        $sub=DB::select('select distinct s.usn,sub.id,sub.subname from subjects sub,attendances a,students s where sub.id=a.subject_id and s.id=a.student_id and s.id=?',[$request->id]);
        // $sub=Subject::all();
        return json_encode($sub);
    }

    public function getstudentmarks(Request $request)
    {
        $internal=1;
        $s=DB::select('select m.mark,m.subject_id from marks m where m.ia=? and m.student_id=? order by m.subject_id',[1, $request->id]);
        return json_encode($s);
    }

    public function getstudentpercentage(Request $request)
    {
        $internal=1;
        $s=DB::select("select a.student_id,a.subject_id,count(a.student_id)/c.no_class*100 as percentage from attendances a,classes c,students s where c.subject_id=a.subject_id and a.student_id=s.id and s.id=? and c.department_id=s.department_id and s.id=a.student_id group by a.subject_id,a.student_id,c.no_class order by c.subject_id",[$request->id]);     
        return json_encode($s);
    }
}
