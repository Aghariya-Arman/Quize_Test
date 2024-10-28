<?php

use App\Http\Controllers\QuestionController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [QuestionController::class, 'index'])->name('homepage');
Route::get('/admin', function () {
    return view('panel.layout.app');
});

Route::get('/check', [QuestionController::class, 'ckeckans'])->name('checkans');
Route::get('/ans', [QuestionController::class, 'result'])->name('finalans');
Route::get('/skip', [QuestionController::class, 'skipquestion'])->name('skipquestion');



Route::get('/addque', [QuestionController::class, 'questionform'])->name('addquestion');
Route::post('/subque', [QuestionController::class, 'submitque'])->name('submitque');
Route::get('/allques', [QuestionController::class, 'showquestion'])->name('showquestion');

Route::get('edit-que/{id}', [QuestionController::class, 'editquestion'])->name('edit');
Route::post('update', [QuestionController::class, 'updatequestion'])->name('update');
Route::get('delque{id}', [QuestionController::class, 'removequestion'])->name('delete');
