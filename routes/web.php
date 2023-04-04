<?php

use Admin\UserController;
use User\Profile;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Mail;
// use App\Mail\SendMail;

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
    return view('index');
});

//user related pages
Route::prefix('users')->middleware(['auth', 'verified'])->name('user.')->group(function(){
    Route::get('profile', Profile::class)->name('profile');
});


//Route::resource('/admin/users', 'Admin\UserController');//Old way
Route::prefix('admin')->name('admin.')->middleware(['auth', 'auth.isAdmin', 'verified'])->group(function(){
    Route::resource('/users', UserController::class);
});

//Overrides fortify register route
//Add the middleware to prevent unauthorized country accessing the registration page.
Route::get('/register-form', function (Request $request) {
    return view('auth.register', ['ipAddress'=>$request->ip()]);
})->name('register-form')->middleware(['check.country']);

//Route::post('/register-user', 'RegisterController@store')->name('register-user');

//Policy protected routes for Admins and moderators only
Route::prefix('policy')->name('policy.')->middleware(['auth', 'verified', 'auth.isAdmin.Moderator'])->group(function(){
    Route::resource('/ideas', PolicyController::class)->except(['create', 'store']);
    Route::post('/approval', 'PolicyController@approval')->name('approval');
});

//Policy protected routes for registered users only
Route::prefix('discuss')->name('discuss.')->middleware('auth')->group(function(){
    Route::resource('/', DiscussionController::class);
});

//Policy open routes to the general public
Route::get('/policy-ideas', 'PolicyController@create')->name('policy-ideas');
Route::post('/policy-store', 'PolicyController@store')->name('policy.store');

/*
Route::get('send-mail', function () {
    $details = [
    'title' => 'Mail from ItSolutionStuff.com',
    'body' => 'This is for testing email using smtp',
    'subject' => 'First test mail',
    'view' => 'mail.test-mail',
    ];
    Mail::to("hello@example.com")->send(new SendMail($details));
    dd("Email is Sent.");
});

*/
