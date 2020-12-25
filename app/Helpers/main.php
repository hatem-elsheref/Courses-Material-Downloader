<?php

define('PAGINATION',10);
define('TOP',6);
define('MANAGER','manager');
define('ADMIN','admin');
define('USER','user');
define('DEFAULT_AVATAR','default-user.png');
define('DEFAULT_TEMPORARY','temporary.jpg');
// return the full path of the assets of dashboard design
if (!function_exists('adminAssets')) {
    function adminAssets($asset)
    {
        return asset('assets/admin/' . $asset);
    }
}

// return the full path of the assets of template-website-front design
if (!function_exists('frontAssets')) {
    function frontAssets($asset)
    {
        return asset('assets/front/' . $asset);
    }
}

// return the full path of the uploads
if (!function_exists('uploadedAssets')) {
    function uploadedAssets($file)
    {
        return asset($file);
    }
}


// function to active the current url admin
if (!function_exists('inTheCurrentRoute')){
    function inTheCurrentRoute($route,$other=null){
        if (request()->is('dashboard/'.$route) or request()->is('dashboard/'.$other) ){
            return  'active';
        }else{
            return (\Illuminate\Support\Facades\Route::getCurrentRoute()->getName() === $route)? 'active':'';
        }
    }
}
// function to active the current url website
if (!function_exists('activeUrl')){
    function activeUrl($route){
        if (request()->is($route) or request()->is($route.'/*'))
            return true;
        else
            return (\Illuminate\Support\Facades\Route::getCurrentRoute()->getName() == $route);

    }
}


// function to toast success
if (!function_exists('success')){
    function success($message='Success Operation'){
        toast($message,'success');
    }
}
// function to toast fail
if (!function_exists('fail')){
    function fail($message='Failed Operation'){
        toast($message,'error');
    }
}

// function to get random image and icon
if (!function_exists('getImage')){
    function getImage(){
        $parent='images/categories/';
        $images=['academics.jpg','marketing.jpg',
                 'photography.jpg','paint.jpg','language.jpg',
                 'lifestyle.jpg','health.jpg','business.jpg',
                 'food.jpg','teacher.jpg','development.jpg',
                 'music.jpg'];
        $icons=['icon-line-book','icon-line-share',
                'icon-line2-camera','icon-paint-brush',
                'icon-line2-globe','icon-line2-game-controller',
                'icon-heartbeat','icon-chart-bar1','icon-food',
                'icon-line2-user','icon-code1','icon-music1'];
        $randomNumber=rand(0,count($icons)-1);
        return [$parent.$images[$randomNumber],$icons[$randomNumber]];
    }
}


function getVideoId($path){
     $query=parse_url($path);$id=null;
    foreach ($query as $key => $value) {
        if ($key == 'query') {
            $values = explode('&', $value);
            foreach ($values as $val) {
                $parts = explode('=', $val);
                if ($parts[0] == 'v') {
                    $id = $parts[1];
                }
            }
        }
    }
    return "https://www.youtube.com/embed/$id";
}
