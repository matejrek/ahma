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

/*HOMEPAGE*/
Route::get('/', 'App\Http\Controllers\WebsiteController@index');

/*COURSES*/
Route::middleware(['auth:sanctum', 'verified'])->get('/courses', 'App\Http\Controllers\WebsiteController@courses')->name('courses');
Route::middleware(['auth:sanctum', 'verified'])->get('/course/{id}', 'App\Http\Controllers\WebsiteController@show');
Route::middleware(['auth:sanctum', 'verified'])->get('/course/lesson/{id}', 'App\Http\Controllers\LessonController@show');


/*ADMIN*/

Route::get('/lessons', 'App\Http\Controllers\LessonController@index')->name('lessons');


Route::get('/lesson/create', 'App\Http\Controllers\LessonController@create');


Route::get('/lesson/{id}', 'App\Http\Controllers\LessonController@show');


Route::get('/lesson/edit/{id}', 'App\Http\Controllers\LessonController@edit');


Route::put('/lesson/{id}/edit/save', 'App\Http\Controllers\LessonController@update');  


Route::post('/lesson/store', 'App\Http\Controllers\LessonController@store');


Route::get('/send', 'App\Http\Controllers\LessonController@send');


Route::get('/lesson/type/create', 'App\Http\Controllers\LessonTypeController@create');

Route::post('/lesson/type/store', 'App\Http\Controllers\LessonTypeController@store');

//enrolls
Route::get('/course/enroll/{id}', 'App\Http\Controllers\LessonController@enroll');


/*stripe*/
Route::get('/billing', 'App\Http\Controllers\SubscriptionController@billingPortal');

Route::get('/update', 'App\Http\Controllers\SubscriptionController@updatePaymentMethod');

Route::get('/subenkr', 'App\Http\Controllers\SubscriptionController@createSubscription');

Route::get('/subende', 'App\Http\Controllers\SubscriptionController@createSubscriptionENDE');

Route::get('/getallsubs', 'App\Http\Controllers\SubscriptionController@UpdateStatus');


Route::get('/subscribe/{id}', 'App\Http\Controllers\SubscriptionController@CreateNewSubscription');

//single payment


Route::get('/single/success', function(){
    return "success";
});

Route::get('/single/cancel', function(){
    return "cancel";
});


