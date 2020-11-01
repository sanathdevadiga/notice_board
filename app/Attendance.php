<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{

    protected $fillable=['student_id','subject_id'];
    public function student(){

        return  $this->belongsTo('App\Student');
    }
}
?>