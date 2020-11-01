<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\_Class;
use App\Department;
use App\Subject;
use Illuminate\Support\Facades\Session;

Route::get('/', function () {
    $events=\App\Event::all();
    return view('welcome',compact('events'));
});

Route::get('/getevents','EventController@getevents')->name('geteve');  ////do from here
Route::get('/test', 'HomeController@getstudentdetails')->name('getsd');

Route::get('/test123',function(){
    $dep=Department::where('dept','CS')
            ->where('sem',1)
            ->where('sec','A')
           ->select(['id'])
               ->get();
               return $dep=$dep[0]->id;
});

Route::get('/getstudentsubject','MarkController@getstudentsubject')->name('getstudentsubject');
Route::get('/getstudentmarks','MarkController@getstudentmarks')->name('getstudentmarks');
Route::get('/getstudentpercentage','MarkController@getstudentpercentage')->name('getstudentpercentage');



Route::get('/deleteevents','EventController@deleteevents')->name('deleteevents');

Route::get('/getid','StudentController@getid')->name('getid');








Route::get('/login', function () {

    return view('login');

})->name('login');

Route::post('/logincheck','HomeController@login')->name('logincheck');
Route::group(['prefix' =>'admin','middleware'=>'auth'],function (){
    Route::get('/home','HomeController@index')->name('home');
    Route::resource('/students','StudentController');
    Route::get('/studentdetails','StudentController@studentdetails')->name('studentdetails');
    Route::get('/studentview','StudentController@view')->name('studentview');
    Route::resource('/attendances','AttendanceController');
    Route::get('/getdept','MarkController@getdept')->name('getdept');
    Route::get('/getsem','MarkController@getsem')->name('getsem');
    Route::get('/getsec','MarkController@getsec')->name('getsec');
    Route::get('/getstaffsubject','MarkController@getstaffsubject')->name('getstaffsubject');
    Route::get('/getallsubject','MarkController@getallsubject')->name('getallsubject');
    Route::get('/getalldept','DepartmentController@getalldept')->name('getalldept');
    Route::get('/getallsem','DepartmentController@getallsem')->name('getallsem');
    Route::get('/getallsec','DepartmentController@getallsec')->name('getallsec');
    Route::get('/getattendances','AttendanceController@getattendances')->name('getattend');
    Route::get('/putattendances','AttendanceController@putattendances')->name('putattend');
    Route::get('/getmarks','MarkController@getmarks')->name('getmarks');
    Route::get('/getallmarks','MarkController@getallmarks')->name('getallmarks');
    Route::get('/putmarks','MarkController@putmarks')->name('putmarks');
    Route::get('/showclass','DepartmentController@showclass')->name('showclass');
    Route::resource('/marks','MarkController');
    Route::resource('/events','EventController');
    Route::resource('/departments','DepartmentController');
    Route::post('/addclass','DepartmentController@addclass')->name('addclass');
    Route::post('/editclass','DepartmentController@editclass')->name('editclass');
    Route::resource('/staffs','StaffController');
    Route::get('/deletedepts','DepartmentController@deletedepts')->name('deletedepts');
    Route::get('/deletestaff','StaffController@deletestaff')->name('deletestaff');
    Route::get('/getstaff','StaffController@getstaff')->name('getstaff');
    Route::get('/getsubject','SubjectController@getsubject')->name('getsubject');

   
    Route::resource('/subjects','SubjectController');
    Route::get('/deletesubject','SubjectController@deletesubject')->name('deletesubject');

});
