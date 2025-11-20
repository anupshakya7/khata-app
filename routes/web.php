<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SavingController;
use App\Http\Controllers\UserController;
use App\Mail\UserVerificationMail;
use App\Models\User;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;


//Authentication
Route::middleware('check.guest')->group(function () {
    //Login
    Route::prefix('login')->name('login')->group(function () {
        Route::get('/', [AuthController::class, 'login']);
        Route::post('/', [AuthController::class, 'loginSubmit'])->name('.submit');
    });

    //Register
    Route::prefix('register')->name('register')->group(function () {
        Route::get('/', [AuthController::class, 'register']);
        Route::post('/', [AuthController::class, 'registerSubmit'])->name('.submit');
    });
});

//Email Verification
Route::get('/email/verify/{id}/{hash}', function ($id, $hash) {
    if (Auth::check()) {
        $route = 'home';
    } else {
        $route = 'login';
    }

    $user = User::find($id);

    if (!$user) {
        return redirect()->route($route)->with('error', 'Invalid Verification Link.');
    }

    if(!$user->email_verification_token){
        return redirect()->route($route)->with('error', 'Invalid or expired verification link.');
    }

    if (!hash_equals($user->email_verification_token, $hash)) {
        return redirect()->route($route)->with('error', 'Invalid or expired verification link.');
    }

    $user->email_verified_at = now();
    $user->email_verification_token = null;

    $user->save();

    return redirect()->route($route)->with('success', 'Email verified successfully!!!');
})->name('verification.verify');

Route::middleware('check.auth')->group(function () {
    Route::get('/', [HomeController::class, 'home'])->name('home');

    //Logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::resources([
        'user' => UserController::class,
        'saving' => SavingController::class
    ]);

    //Saving History
    Route::prefix('saving/history')->name('saving.')->group(function(){
        Route::get('/{saving}',[SavingController::class,'history'])->name('history');
    });

    //Saving Check User
    Route::get('saving/verify/check-user',[SavingController::class,'checkUser'])->name('saving.check-user');
});
