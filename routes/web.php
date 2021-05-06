<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\InvitationEmailController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

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


Route::get('/logout', function (Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return ["return"=>true];
});






// email verify
Route::get('/email/verify', function () {
    return view('auth.verify');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect('/home');
})->middleware(['auth', 'signed'])->name('verification.verify');


Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.resend');



// home
Route::get('/home', [HomeController::class, 'index'])->name('home')->middleware('verified');;
Route::get('admin/home', [HomeController::class, 'adminHome'])->name('admin.home')->middleware('is_admin');



// admin
Route::get('/admin/sendInvitationEmail', function () {
    return view('admin.sendInvitationEmail');
})
->name('sendInvitationEmail')->middleware('is_admin');

Route::prefix('admin/api/invitationEmail')->middleware('is_admin')->group( function () {
    Route::post('/store', [InvitationEmailController::class, 'store']);
    Route::put('/{id}', [InvitationEmailController::class, 'update']);
    Route::delete('/{id}', [InvitationEmailController::class, 'destroy']);
}
);



// guest
Route::get('/register/{code}', [InvitationEmailController::class, 'show']);




// user
Route::resource('/user', UserController::class);







// Auth
Auth::routes();
