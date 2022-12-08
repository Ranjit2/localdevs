<?php

use App\Http\Controllers\TalentFilterController;
use App\Http\Controllers\UserProfileController;
use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

Auth::routes();
Route::post('filter/talents', [TalentFilterController::class, 'index']);
Route::get('skills', [TalentFilterController::class, 'skills']);
Route::get('design', [TalentFilterController::class, 'design']);


Route::post('/user/profile', [UserProfileController::class, 'store']);
Route::get('/userbased-skills', [UserProfileController::class, 'findSkillListsForloggedInUser']);
Route::get('/user/detials', [UserProfileController::class, 'userDetails']);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::any('{all}', function () {
    return view('home');
})->where(['all' => '.*']);
