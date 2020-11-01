<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class _Class extends Model
{
    protected $table="classes";
    protected $fillable=['department_id','subject_id','staff_id','no_class'];
}
