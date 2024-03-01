<?php

use App\Http\Controllers\Events\EventController;
use App\Http\Controllers\Livestream\LivestreamController;
use App\Http\Controllers\Message\LatestMessageController;
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

/** Temporary Pages */
Route::redirect('/events/silentretreat', 'https://www.elexiogiving.com/App/Form/43503380-4509-4be6-9488-64f4fa49e644')->name('events.silentretreat');
Route::view('/jedicamp', 'pages.events.jedi-camp-2024')->name('events.jedi-camp');
/** End of Temporary Pages */
Route::view('/', 'pages.home')->name('home');

Route::view('/contact-us', 'pages.contact-us')->name('contact-us');

Route::group(['prefix' => 'about'], function () {
    Route::view('/', 'pages.about.what-we-believe')->name('about');
    Route::view('/what-we-believe', 'pages.about.what-we-believe')->name('about.what-we-believe');
    Route::view('/staff', 'pages.about.staff')->name('about.staff');
});

Route::resource('events', EventController::class)->only(['index', 'show']);

Route::resource('livestream', LivestreamController::class)->only(['index', 'show']);

Route::group(['prefix' => 'messages'], function () {
    Route::view('/', 'pages.messages')->name('messages');
    Route::get('/latest', [LatestMessageController::class, 'redirect'])->name('messages.latest');
});

Route::get('/newsletter/verify', VerifyNewsletterEmailAddressController::class)
    ->name('newsletter.verify')
    ->middleware(['throttle:5,1']);
