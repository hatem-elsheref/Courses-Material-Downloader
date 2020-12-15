<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $table='courses';
    protected $fillable=['name','slug','description','photo','price','category_id','instructor_id'];


    public function category(){
        return $this->belongsTo('App\Category','category_id','id');
    }
    public function instructor(){
        return $this->belongsTo('App\Instructor','instructor_id','id');
    }
    public function materials(){
        return $this->hasMany('App\Material','course_id','id');
    }
}
