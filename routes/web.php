<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\TalentFilterController;
use App\Http\Controllers\UserProfileController;
use App\Models\User;
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
/**
 * Email verification: https://laravel.com/docs/7.x/verification
 * include verify=>true in Auth::routes()
 * enable MustVerifyEmail in user model
 * implement MustVerifyEmail
 * include ->middleware('verified') in route
 * now laravel will automatically send email
 */
use Illuminate\Foundation\Auth\EmailVerificationRequest;
 
Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect('/home');
})->middleware(['auth', 'signed'])->name('verification.verify');
Route::get('/', function () {

    // if (auth()->user()->email_verified_at == '') {
    //     return redirect()->to('/email/verify');
    // }
    return redirect()->to('/home');
});

Auth::routes(['verify' => true]);

Route::get('/forHeader', function() {
    return User::where('id',auth()->id())->first()->slug;
});



// routes/web.php

use App\Http\Controllers\Auth\PasswordlessAuthenticationController;
use App\Http\Controllers\BusinessController;
use App\Http\Controllers\MessageController;

// Route::get('/login', [PasswordlessLoginController::class, 'showLoginForm'])->name('login');
// Route::post('/login', [PasswordlessAuthenticationController::class, 'sendLink'])->name('passwordless.login');
// Route::get('/login/{user}', [PasswordlessAuthenticationController::class, 'authenticateUser'])->name('passwordless.authenticate');
// Route::post('/logout', [PasswordlessAuthenticationController::class, 'logout'])->name('logout');

Route::view('devs-talks', 'meetup.index')->name('devs-talks');
Route::view('create-devs-talks', 'meetup.create-devs-talks')->name('create-devs-talks');

Route::get('filter/talents', [TalentFilterController::class, 'index']);
Route::get('skills', [TalentFilterController::class, 'skills']);
Route::get('design', [TalentFilterController::class, 'design']);

Route::post('users',[TalentFilterController::class, 'user']);
Route::get('/talent/{slug}', [TalentFilterController::class, 'view']);
Route::get('/user/register', [TalentFilterController::class, 'register'])->name('user.register');
Route::get('/company/register', [BusinessController::class, 'companyRegister'])->name('company.register');
Route::post('/company/register', [BusinessController::class, 'postCompanyRegister'])->name('post.company.register');


Route::post('/user/profile', [UserProfileController::class, 'store']);
Route::get('/userbased-skills', [UserProfileController::class, 'findSkillListsForloggedInUser']);
Route::get('/user/details', [UserProfileController::class, 'userDetails']);
Route::post('/user/additional/skills', [UserProfileController::class, 'additionalSkills']);
Route::get('/user/additional/skills', [UserProfileController::class, 'getAdditionalSkills']);
Route::post('/delete/user/additional/skills', [UserProfileController::class, 'deleteAdditionalSkills']);

Route::get('places',[UserProfileController::class, 'places']);
//Route::get('/user/dashboard', [UserProfileController::class, 'dashboard']);
Route::post('profileImage/upload', [UserProfileController::class, 'uploadToS3']);
Route::get('upload',[UserProfileController::class, 'index']);
Route::post('user/update-education',[UserProfileController::class, 'updateEducation']);
Route::post('user/update-experience', [UserProfileController::class, 'updateExperience']);
Route::post('user/social', [UserProfileController::class, 'social']);
Route::get('get-user-social', [UserProfileController::class, 'getSocial']);
Route::post('user/employment/history', [UserProfileController::class, 'employment']);
Route::get('user/employment/history', [UserProfileController::class, 'getEmploymentHistory']);
Route::post('delete/employment/history', [UserProfileController::class, 'deleteEmploymentHistory']);

//Route::get('/user/profile/{user}/edit', [UserProfileController::class, 'edit']);
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('verified');


Route::view('message','message');
//Route::get('/messages', [MessageController::class, 'fetchMessages']);
Route::post('/messages', [MessageController::class, 'store']);
Route::get('/users', [MessageController::class, 'fetchUsers']);
Route::get('/messages/show/{receiverId}', [MessageController::class, 'show']);


Route::get('/user/role',function() {
    $userRole = User::where('id',auth()->id())->first()->is_user;
    if($userRole == 'talent') {
        return response()->json(['user' => 'talent']);
    }
});


//spa
//disable above /talent/{slug} route
//enable profile route from routes.js
// Route::get('/talent/profile/{slug}', function($slug) {
//     return \App\Models\User::where('slug', $slug)->first();
// });

Route::get('/{any}', function () {
    return view('home');
})->where('any', '.*');

