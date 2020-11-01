<?php

namespace App\Http\Controllers;

use App\Attendance;
use App\Staff;
use App\Student;
use App\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    public function getstudentdetails(){
        $id=Student::where('id',1)->get()[0]->id;
        $subjects=Attendance::where('student_id',$id)->select('subject_id')->distinct()->get();
        $subjects=Subject::whereIn('id',$subjects)->get();
        $student_attendance=DB::select('select count(a.student_id) as attend,sub.subname from students s,subjects sub,attendances a where s.id=? and a.student_id=s.id and a.subject_id=sub.id group by sub.subname order by sub.subname',[$id]);
        $student_marks=DB::select('select m.ia,m.mark,sub.subname from students s,subjects sub,marks m where s.id=? and m.student_id=s.id and m.subject_id=sub.id order by sub.subname',[$id]);
        return json_encode(compact('student_attendance','student_marks'));
    }


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function login(Request $request) {
       // dd($request->all());
        $users=Staff::where('ssn',$request->ssn)->where('pwd',$request->password)->get();
       // dd($users);
        if (count($users))
        {

            session(['id' => $users[0]->id]);
            return \redirect()->route('home');
        } else {

            Session::flash ( 'message', "Invalid Credentials , Please try again." );
            return Redirect::back ();
        }
    }

    public function index()
    {

        return view('home');

    }
}
