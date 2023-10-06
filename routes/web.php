<?php

use App\Http\Controllers\Message\LatestMessageController;
use App\Http\Controllers\Newsletter\VerifyNewsletterEmailAddressController;
use App\Models\Event;
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

Route::redirect('/about', '/about/what-we-believe')->name('about');
Route::view('/about/what-we-believe', 'pages.about.what-we-believe')->name('about.what-we-believe');
Route::view('/about/staff', 'pages.about.staff')->name('about.staff');

Route::view('/contact-us', 'pages.contact-us')->name('contact-us');

Route::view('/events', 'pages.events')->name('events');
Route::get('/events/{event:slug}', fn (Event $event) => view('pages.events.event', compact('event')))->name('events.show');

Route::view('/messages', 'pages.messages')->name('messages');
Route::get('/messages/latest', [LatestMessageController::class, 'redirect'])->name('messages.latest');

Route::get('/newsletter/verify', VerifyNewsletterEmailAddressController::class)->name('newsletter.verify')->middleware(['throttle:5,1']);

Route::get('/livestream/sunday', fn () => redirect('https://youtu.be/'.cache()->get('livestream.sunday')))->name('livestream.sunday');
Route::get('/livestream/wednesday', fn () => redirect('https://youtu.be/'.cache()->get('livestream.wednesday')))->name('livestream.wednesday');
Route::get('/livestream',
    fn () => match (now()->dayOfWeek) {
        3 => redirect()->route('livestream.wednesday'),
        default => redirect()->route('livestream.sunday'),
    }
)->name('livestream');
