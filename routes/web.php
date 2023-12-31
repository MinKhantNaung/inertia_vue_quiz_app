<?php

use App\Http\Controllers\AnswerController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\QuizController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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
    return Inertia::render('Home');
});

Route::resource('/questions', QuestionController::class);
Route::resource('/answers', AnswerController::class);
Route::resource('/quizes', QuizController::class);
Route::post('/answers/update', [AnswerController::class, 'updateAnswers']);
Route::get('/show-quizes', [QuizController::class, 'showAllQuizes']);
Route::post('/results', [QuizController::class, 'showResult']);
// for return home page when enter not exist route
Route::fallback(function() {
    return Inertia::render('Home');
});
