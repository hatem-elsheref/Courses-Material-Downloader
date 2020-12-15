<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Instructor extends Model
{
    protected $table='instructors';
    protected $fillable=['name','job','email','photo'];

    public function courses(){
        return $this->hasMany('App\Course','instructor_id','id');
    }
}
