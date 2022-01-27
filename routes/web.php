<?php

use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

//Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
//    return view('dashboard');
//})->name('dashboard');

Route::group(['middleware' => 'auth:sanctum'],function(){
    Route::get('dashboard',function(){
        return view('dashboard');
    })->name('dashboard');


    // Admin Route
    Route::group(['middleware' => 'admin', 'namespace' => '\App\Http\Controllers\Admin'],function() {
        Route::resource('schools', 'SchoolController');
        Route::resource('students', 'StudentController');
    });
});
