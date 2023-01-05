<?php

use App\Models\AuthorModule\CoursePackage;
use App\Models\Classes;
use App\Models\Course;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use Laravel\Nova\Nova;

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

Route::group(['middleware' => 'guest'], function() {
    require __DIR__ . '/front.php';
});
require __DIR__ . '/auth.php';

Route::get('change-locale/{locale}', [App\Http\Controllers\UserSettingsController::class, 'changeLocale'])
    ->name('change-locale')
    ->where('locale', 'en|sv_SE');

Route::group(['middleware' => 'auth'], function(){
    require __DIR__ . '/student.php';
});
