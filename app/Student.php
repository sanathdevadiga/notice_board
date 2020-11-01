<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable=
        [
            'name','usn','phone','dob','email','gphone','gname','department_id','address'
        ];


    public function department(){

      return  $this->belongsTo('App\Department');
    }
    public function attendances(){

        return  $this->hasMany('App\Attendance');
    }
    public function marks(){

        return  $this->hasMany('App\Mark');
    }
}
