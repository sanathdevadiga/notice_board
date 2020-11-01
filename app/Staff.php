<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{


    protected $fillable=['name','ssn','pwd','role_id'];
    public function role(){
        return $this->belongsTo('App\Role');
    }
}
