<?php

use Carbon\Carbon;
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

Route::get('time', function () {
    return response()->json([
        'time' => Carbon::parse((string) now()),
    ]);
});

Route::group(['namespace' => "App\Http\Controllers\API"], function () {
    Route::group([], function () {
        Route::get('pertanyaan', 'QuestionController@index')->name('api.questions.index');
        Route::delete('pertanyaan', 'QuestionController@destroy')->name('api.questions.destroy');

        Route::get('ujian/statistics', 'ExamController@getExamStatistics')->name('api.exams.stats');

        Route::get('ujian/{examResultId}/pertanyaan/{questionId}', 'ExamController@getQuestion')->name('api.exams.question');
        Route::get('ujian/{examResultId}/pertanyaan/{questionId}/next', 'ExamController@getNextQuestion')->name('api.exams.question.next');
        Route::get('ujian/{examResultId}/pertanyaan/{questionId}/previous', 'ExamController@getPreviousQuestion')->name('api.exams.question.previous');

        Route::put('ujian/{examResultId}/pertanyaan/{questionId}/save', 'ExamController@saveQuestion')->name('api.exams.question.save');
        Route::put('ujian/{examResultId}/pertanyaan/{questionId}/not-sure', 'ExamController@notSure')->name('api.exams.question.not-sure');

        Route::put('ujian/{id}/finish', 'ExamController@finishExam')->name('api.exams.finish');
        Route::get('ujian/{id}/remaining', 'ExamController@remainingExamTime')->name('api.exams.remaining-time');
    });
});
