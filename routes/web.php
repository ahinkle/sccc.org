<?php

use App\Http\Controllers\Newsletter\VerifyNewsletterEmailAddressController;
use Illuminate\Support\Facades\Route;

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

Route::view('/', 'pages.home')->name('home');
Route::view('/about/what-we-believe', 'pages.about.what-we-believe')->name('about.what-we-believe');
Route::view('/about/staff', 'pages.about.staff')->name('about.staff');
Route::view('/contact-us', 'pages.contact-us')->name('contact-us');
Route::view('/events', 'pages.events')->name('events');
Route::get('/newsletter/verify', VerifyNewsletterEmailAddressController::class)->name('newsletter.verify')->middleware(['throttle:5,1']);

Route::get('/livestream/sunday', fn () => redirect('https://youtu.be/'.cache()->get('livestream.sunday')))->name('livestream.sunday');
Route::get('/livestream/wednesday', fn () => redirect('https://youtu.be/'.cache()->get('livestream.wednesday')))->name('livestream.wednesday');
