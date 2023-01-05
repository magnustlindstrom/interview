<?php

$pages = ['home', 'learn', 'review', 'lessons', 'profile', 'settings'];

foreach ($pages as $page) {
    Route::view("{$page}", "layouts.student")
        ->name("student.{$page}");
}

Route::post('class', function () {
    $details = auth()->user()->details;
    $details->selected_class_id = request()->input('class_id');
    $details->save();
    return redirect()->back();
})
    ->name('class.update');

Route::get('exercise-block/{exercise}', [\App\Http\Controllers\LearnController::class, 'getExerciseBlock']);
Route::get('exercise-block/{exercise}/repeat', [\App\Http\Controllers\LearnController::class, 'fetchRepeatQuestions']);
Route::post('question/fetch', [\App\Http\Controllers\LearnController::class, 'fetchQuestion']);
Route::post('question/answer', [\App\Http\Controllers\LearnController::class, 'checkAnswers']);

Route::post('settings/theme', [App\Http\Controllers\UserSettingsController::class, 'changeTheme']);
Route::post('settings/locale', [App\Http\Controllers\UserSettingsController::class, 'changeLocale']);
