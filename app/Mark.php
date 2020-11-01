<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mark extends Model
{
    protected $fillable=['subject_id','student_id','ia','mark'];
    public function student(){
        return  $this->belongsTo('App\Student');
    }
}
