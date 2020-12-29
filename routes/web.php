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
Route::get('/soon', 'App\Http\Controllers\WebsiteController@soon');

/*LANGUAGES*/
Route::get('/lang/{locale}', function ($locale) {
    if (! in_array($locale, ['en', 'kr'])) {
        abort(400);
    }
    \Session::put('locale',$locale);
    return redirect()->back();
});

/*COURSES*/
Route::middleware(['auth:sanctum', 'verified'])->get('/courses', 'App\Http\Controllers\WebsiteController@courses')->name('courses');
Route::middleware(['auth:sanctum', 'verified'])->get('/course/{id}', 'App\Http\Controllers\LessonController@course');
Route::middleware(['auth:sanctum', 'verified'])->get('/course/lesson/{id}', 'App\Http\Controllers\LessonController@show');

Route::middleware(['auth:sanctum', 'verified'])->get('/unlockLessonData/{id}', 'App\Http\Controllers\LessonController@unlockLessonData');
Route::middleware(['auth:sanctum', 'verified'])->get('/single/success', 'App\Http\Controllers\LessonController@singlePurchaseSuccess');
Route::middleware(['auth:sanctum', 'verified'])->get('/single/cancel', 'App\Http\Controllers\LessonController@singlePurchaseCancel');
Route::middleware(['auth:sanctum', 'verified'])->get('/single/error', 'App\Http\Controllers\LessonController@singlePurchaseError');
Route::middleware(['auth:sanctum', 'verified'])->get('/single/success/completed', 'App\Http\Controllers\LessonController@singlePurchaseCompleted');


/*ADMIN*/
Route::middleware(['auth:sanctum', 'verified'])->get('/admin', 'App\Http\Controllers\LessonController@index');
Route::middleware(['auth:sanctum', 'verified'])->get('/admin/lesson/create', 'App\Http\Controllers\LessonController@create');
Route::middleware(['auth:sanctum', 'verified'])->get('/admin/lesson/{id}', 'App\Http\Controllers\LessonController@show');
Route::middleware(['auth:sanctum', 'verified'])->get('/admin/lesson/edit/{id}', 'App\Http\Controllers\LessonController@edit');
Route::middleware(['auth:sanctum', 'verified'])->post('/admin/lesson/{id}/edit/save', 'App\Http\Controllers\LessonController@update');  
Route::middleware(['auth:sanctum', 'verified'])->post('/admin/lesson/store', 'App\Http\Controllers\LessonController@store');
Route::middleware(['auth:sanctum', 'verified'])->get('/admin/send', 'App\Http\Controllers\LessonController@send');
Route::middleware(['auth:sanctum', 'verified'])->get('/admin/lesson/type/create', 'App\Http\Controllers\LessonTypeController@create');
Route::middleware(['auth:sanctum', 'verified'])->post('/admin/lesson/type/store', 'App\Http\Controllers\LessonTypeController@store');



//enrolls
Route::get('/course/enroll/{id}', 'App\Http\Controllers\LessonController@enroll');


/*stripe*/
Route::get('/billing', 'App\Http\Controllers\SubscriptionController@billingPortal');

Route::get('/update', 'App\Http\Controllers\SubscriptionController@updatePaymentMethod');

Route::get('/subenkr', 'App\Http\Controllers\SubscriptionController@createSubscription');

Route::get('/subende', 'App\Http\Controllers\SubscriptionController@createSubscriptionENDE');

Route::get('/getallsubs', 'App\Http\Controllers\SubscriptionController@UpdateStatus');


Route::get('/course/subscribe/{id}', 'App\Http\Controllers\SubscriptionController@CreateNewSubscription');

//single payment


/*Route::get('/single/success', function(){
    return "success";
});*/

/*Route::get('/single/cancel', function(){
    return "cancel";
});
**/

