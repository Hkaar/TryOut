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

Route::group(['namespace' => "App\Http\Controllers"], function () {
    Route::get('/', 'HomeController@welcome')->name('/');

    Route::group(['middleware' => ['auth']], function () {
        Route::get('home', 'HomeController@index')->name('home');

        Route::get('ujian', 'ExamController@index')->name('exams.index');
        Route::get('ujian/{id}', 'ExamController@show')->name('exams.show');

        Route::get('riwayat-ujian', 'ExamHistoryController@index')->name('exam-history.index');
        Route::get('riwayat-ujian/{id}', 'ExamHistoryController@show')->name('exam-history.show');
    });
});

Route::group(['namespace' => "App\Http\Controllers\Auth"], function () {
    Route::group(['middleware' => ['guest']], function () {
        Route::post('login', 'LoginController@login')->name('login.post');
        Route::get('login', 'LoginController@show')->name('login');
    });

    Route::group(['middleware' => ['auth']], function () {
        Route::get('logout', 'LogoutController@perform')->name('logout');
    });
});

Route::group(['namespace' => "App\Http\Controllers\Admin", 'prefix' => 'manage', 'middleware' => ['auth', 'can:access-dashboard']], function () {
    Route::get('home', 'HomeController@index')->name('admin.home');

    Route::resource('paket-soal', 'PacketController')->names('admin.packets');
    Route::resource('pertanyaan', 'QuestionController')->names('admin.questions');
    Route::resource('mapel', 'SubjectController')->names('admin.subjects');

    Route::group(['middleware' => ['can:admin']], function () {
        Route::get('pengaturan', 'SettingsController@edit')->name('admin.settings');
        Route::put('pengaturan', 'SettingsController@update')->name('admin.settings.update');
        
        Route::resource('ujian', 'ExamController')->names('admin.exams');
        Route::resource('riwayat-ujian', 'ExamHistoryController')->names('admin.exam-history');
        Route::resource('peserta', 'StudentController')->names('admin.students');
        Route::resource('pengguna', 'UserController')->names('admin.users');
        Route::resource('group', 'GroupController')->names('admin.groups');
    });
});
