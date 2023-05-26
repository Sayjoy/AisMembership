<?php

use Admin\UserController;
use App\Http\Controllers\PollElementController;
use User\ProfileController;
use App\Models\Category;
use App\Models\PollElement;
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

Route::get('/', 'PolicyController@create');

//user related pages
Route::prefix('users')->middleware(['auth', 'verified'])->name('user.')->group(function(){
    //Route::get('profile', Profile::class)->name('profile');
    Route::resource('/profile', ProfileController::class);
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


//Policy protected routes for Admins and moderators only
Route::prefix('policy')->name('policy.')->middleware(['auth', 'verified', 'auth.isAdmin.Moderator'])->group(function(){
    Route::resource('/ideas', PolicyController::class)->except(['create', 'store', 'show']);
    Route::post('/approval', 'PolicyController@approval')->name('approval');
    Route::get('/publish/{policy_id}', 'PolicyController@publish')->name('publish');
    Route::resource('/category', CategoryController::class);
    Route::get('/bycategory/{category_id}', 'PolicyController@index')->name('byCategory');
});

//Policy protected routes for registered and verified users only
Route::get('/policy/{policy_id}', 'PolicyController@show')->middleware('auth', 'verified')->name('policy.show');

Route::prefix('discuss')->name('discuss.')->middleware('auth', 'verified')->group(function(){
    Route::resource('/', DiscussionController::class);
    Route::get('/bycategory/{category_id}', 'DiscussionController@byCategory')->name('byCategory');
});

//Policy open routes to the general public
Route::get('/policy-ideas', 'PolicyController@create')->name('policy-ideas');
Route::post('/policy-store', 'PolicyController@store')->name('policy.store');
Route::get('/policies-published', 'PolicyController@publishedPolicies')->name('policies.published');
Route::get('/policies-published/{category_id}', 'PolicyController@publishedPolicies')->name('policies.published.byCategory');
Route::get('/policy-published/{policy_id}', 'PolicyController@showPublished')->name('policy.published');

//POll for admin and moderators
Route::prefix('poll')->name('poll.')->middleware(['auth', 'verified', 'auth.isAdmin.Moderator'])->group(function()
{
    Route::resource('/entity', PollController::class);
    Route::resource('/questions', PollElementController::class)->except('create', 'edit', 'submitPoll');
    Route::get('/create/questions/{poll_id}/{q_no}', 'PollElementController@create')->name('questions.create');
    Route::get('/edit/questions/{poll_id}/{q_no?}', 'PollElementController@edit')->name('questions.edit');
});

//Poll for members
Route::prefix('poll')->name('poll.')->middleware(['auth', 'verified'])->group(function()
{
    Route::POST('/submit', 'PollElementController@submitPoll')->name('submit');
});

