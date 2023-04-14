<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::get('/registerform', [UserController::class, 'registerForm']);
Route::get('/loginform', [UserController::class, 'loginForm'])->name('loginForm');


Route::post('/register', [UserController::class, 'register'])->name('register');
Route::post('/login', [UserController::class, 'login'])->name('login');



// Route::group(['prefix' => 'user', 'controller' => AuthController::class], function () {
//     /* Email Verification */
//     Route::get('email-verification', [AuthController::class, 'emailVerificationForm'])
//         ->name('email-verification');

//     /* Email OTP Verification */
//     Route::post('send-verification-email-otp', [AuthController::class, 'sendEmailVerificationOTP'])
//         ->name('send-verification-email-otp');

//     /* OTP Verification */
//     Route::get('otp-verification/{email}', [AuthController::class, 'otpVerificationForm'])
//         ->name('otp-verification');

//     /* OTP Verification Process */
//     Route::post('otp-verification-process', [AuthController::class, 'otpVerificationProcess'])
//         ->name('otp-verification-process');

//     /* Thank you page */
//     Route::get('thank-you/{id}', [AuthController::class, 'thankYouPage'])
//         ->name('thank-you-page');

//     Route::get('resend-otp/{id}', [AuthController::class, 'resendOTP'])
//         ->name('resend-otp');

//     Route::post('{id}/store-wallet-id', [AuthController::class, 'storeWalletID'])
//         ->name('store-wallet-id');

//     Route::post('nft/status', [AuthController::class, 'nftStatusUpdate'])
//         ->name('nft-status');

//     /* route for razorpay options page */
//     Route::get('/become-member', 'becomeMember')->name('become-member');
//     //to test and design subscribe mail template
//     Route::get('/subscribe-mail-template', 'subscribeMailTemplate')->name('subscribe-mail-template');
//     Route::get('/unsubscribe/{email}', 'unsubscribe')->name('unsubscribe');
//     Route::get('/unsubscribe-confirm/{email}', 'unsubscribeConfirm')->name('unsubscribe-confirm');
//     Route::get('/unsubscribe-success/{email}', 'unsubscribeSuccess')->name('unsubscribe-success');
// });
