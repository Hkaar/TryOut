<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::group(["namespace" => "App\Http\Controllers"], function () {
    Route::get('/', 'HomeController@welcome')->name('/');
    
    Route::group(["middleware" => ["auth"]], function () {
        Route::get('home', 'HomeController@index')->name('home');

        Route::get('exams', 'ExamController@index')->name('exams.index');
        Route::get('exams/{id}', 'ExamController@show')->name('exams.show');
    });
});

Route::group(["namespace" => "App\Http\Controllers\Auth"], function () {
    Route::group(["middleware" => ["guest"]], function () {
        Route::post("login", "LoginController@login")->name('login.post');
        Route::get('login', "LoginController@show")->name('login');
    });

    Route::group(["middleware" => ["auth"]], function() {
        Route::get("logout", "LogoutController@perform")->name('logout');
    });
});

Route::group(["namespace" => "App\Http\Controllers\Admin", "prefix" => "manage", "middleware" => ["can:access-dashboard"]], function () {
    Route::get("home", "HomeController@index")->name("admin.home");

    Route::resource('packets', 'PacketController')->names('admin.packets');
    Route::resource('questions', 'QuestionController')->names('admin.questions');
    Route::resource('subjects', 'SubjectController')->names('admin.subjects');

    Route::group(["middleware" => ["can:admin"]], function () {
        Route::resource('exams', 'ExamController')->names('admin.exams');
        Route::resource('students', 'StudentController')->names('admin.students');
        Route::resource('users', "UserController")->names('admin.users');
        Route::resource('groups', 'GroupController')->names('admin.groups');
    });
});
