<?php

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
