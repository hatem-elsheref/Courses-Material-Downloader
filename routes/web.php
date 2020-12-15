<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// for user
Route::get('/', 'PageController@index')->name('website');//done
Route::get('/about', 'PageController@about')->name('about');//done
Route::get('/contact', 'PageController@contact')->name('contact');//done
Route::post('/contact', 'PageController@sendContact')->name('contact.send');//done
Route::get('/courses', 'PageController@courses')->name('courses');//done
Route::get('/category/{slug}', 'PageController@searchByCategory')->name('search.by.category');//done
Route::get('/instructor/{id}', 'PageController@searchByInstructor')->name('search.by.instructor');//done
Route::get('/search', 'PageController@searchByKeyword')->name('search.by.keyword');//done
Route::get('/courses/{slug}', 'PageController@courseDetails')->name('courses.details');//done
Route::get('/account', 'UserController@showProfile')->name('profile.show');
Route::put('/account', 'UserController@updateProfile')->name('profile.update');
Route::get('/download/{id}', 'PageController@download')->name('download')->middleware('auth');

// for all
Auth::routes(['password.request'=>false,'reset'=>false]);

// for admin
Route::group(['prefix'=>'dashboard','middleware'=>['auth','admin:'.ADMIN.','.MANAGER]],function (){
Route::get('/', 'DashboardController@index')->name('dashboard');//done
Route::get('/admin/all','UserController@indexAdmins')->name('admins');//done
Route::get('/user/all','UserController@indexUsers')->name('users');//done
Route::put('/user/{user}','UserController@updateRole')->name('users.role');//done
Route::resource('/instructor','InstructorController');//done
Route::resource('/category','CategoryController');//done
Route::resource('/course','CourseController');//done
Route::resource('/material','MaterialController')->except(['show','index','create']);//done
Route::get('/material/{course}/create','MaterialController@create')->name('material.create');//done
Route::get('/contacts','DashboardController@contacts')->name('contacts.show');//done
Route::delete('/contacts/{id}','DashboardController@destroyContact')->name('contacts.destroy');//done
Route::get('/contacts/{id}','DashboardController@updateContact')->name('contacts.update');//done
});
