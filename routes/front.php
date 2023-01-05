<?php

Route::get('{page}', function ($page = 'home') {
    return response()->view("pages.{$page}");
})
    ->name('pages')
    ->where('page', '|about-us|contact');


Route::view('login','pages.login')
    ->middleware('guest')
    ->name('login');
