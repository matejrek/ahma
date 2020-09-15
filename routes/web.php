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

Route::get('/', function () {
    return view('welcome');
});


Route::get('/lessons', 'App\Http\Controllers\LessonController@index')->name('lessons');


Route::get('/lesson/create', 'App\Http\Controllers\LessonController@create');


Route::get('/lesson/{id}', 'App\Http\Controllers\LessonController@show');


Route::get('/lesson/edit/{id}', 'App\Http\Controllers\LessonController@edit');


Route::put('/lesson/{id}/edit/save', 'App\Http\Controllers\LessonController@update');  


Route::post('/lesson/store', 'App\Http\Controllers\LessonController@store');

Route::get('/new', function(){
    return 'AHMA';
});


Route::get('/send', 'App\Http\Controllers\LessonController@send');



Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
