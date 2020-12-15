<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table='categories';
    protected $fillable=['name','slug'];

    public function courses(){
        return $this->hasMany('App\Course','category_id','id');
    }
}
