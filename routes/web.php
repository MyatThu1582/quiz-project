<?php

use App\Http\Controllers\AnswerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserQuizController;
use App\Models\Quiz;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $quizzes = Quiz::all(); // or with any conditions like active ones only
    return view('welcome', compact('quizzes'));
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    'is_admin'
])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});


Route::middleware(['auth', 'is_admin'])->group(function () {
    Route::resource('users', UserController::class);
    Route::resource('quizzes', QuizController::class);
    Route::resource('questions', QuestionController::class);
    Route::resource('questions.answers', AnswerController::class);
});

Route::middleware(['auth'])->group(function () {
    Route::get('/quiz/{quiz}/start', [UserQuizController::class, 'start'])->name('user.quiz.start');
    Route::post('/quiz/{quiz}/answer', [UserQuizController::class, 'submitAnswer'])->name('user.quiz.answer');
    Route::get('/quiz/{quiz}/result', [UserQuizController::class, 'showResult'])->name('user.quiz.result');
});
