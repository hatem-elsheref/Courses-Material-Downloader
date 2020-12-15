<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    protected $table='materials';
    protected $fillable=['title','path','year','part','download_name','type','course_id','source','mimeType','fileSize','download'];

    public function course(){
        return $this->belongsTo('App\Course','course_id','id');
    }

    public static function types(){
        return ['exam','book','chapter','slide','video','audio','image'];
    }
    public static function sources(){
        return ['Uploading','External_Host','Youtube'];
    }
}
