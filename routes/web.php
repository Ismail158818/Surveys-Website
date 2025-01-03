<?php
use App\Http\Controllers\AdminController;
use App\Http\Controllers\MainPageController;
use App\Http\Controllers\ProfileController;
use App\Http\Middleware\AdminMiddleware;
use Illuminate\Support\Facades\Route;

Route::get('/', [MainPageController::class, 'sent_survey'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::controller(AdminController::class)->group(function () {
    Route::get('admin-page', 'admin_page')->middleware(AdminMiddleware::class)->name('admin.page');
    Route::post('add-survey', 'add_survey')->name('add.survey');
    Route::post('add-questions-answers', 'add_questions_answers')->name('add.questions.answers');
    Route::post('delete', 'delete')->name('delete');
    Route::post('analysis','analysis')->name('analysis');
});

Route::controller(MainPageController::class)->group(function () {
    Route::post('/submit-survey/{surveyId}', 'submitSurvey')->name('submitSurvey');
});

require __DIR__.'/auth.php';
