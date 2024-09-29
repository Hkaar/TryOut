<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::group(['prefix' => 'manage', 'namespace' => "App\Http\Controllers\API"], function () {
    Route::group([], function () {
        Route::get('pertanyaan', 'QuestionController@index')->name('api.admin.questions.index');
        Route::delete('pertanyaan', 'QuestionController@destroy')->name('api.admin.questions.destroy');

        Route::get('ujian/statistics', 'ExamController@getExamStatistics')->name('api.admin.exams.stats');
    });
});
