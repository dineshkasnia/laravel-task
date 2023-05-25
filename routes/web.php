<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\EventController;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [HomeController::class, 'home'])->name('home');

Route::get('login', [LoginController::class, 'login'])->name('login');
Route::post('login/post', [LoginController::class, 'loginPost'])->name('login.post');

Route::get('logout', [HomeController::class, 'logout'])->name('logout');

Route::get('genre', [HomeController::class, 'genre'])->name('genre');
Route::post('genre/post', [HomeController::class, 'genrePost'])->name('genre.post');
Route::get('genre/edit/{id}', [HomeController::class, 'genreEdit'])->name('genre.edit');
Route::post('genre/edit/post', [HomeController::class, 'genreEditPost'])->name('genre.edit.post');

Route::get('delete/{item}/{id}', [HomeController::class, 'deleteItem'])->name('delete.item');

Route::get('artist', [HomeController::class, 'artist'])->name('artist');
Route::post('artist/post', [HomeController::class, 'artistPost'])->name('artist.post');
Route::get('artist/edit/{id}', [HomeController::class, 'artistEdit'])->name('artist.edit');
Route::post('artist/edit/post', [HomeController::class, 'artistEditPost'])->name('artist.edit.post');

Route::get('venue', [HomeController::class, 'venue'])->name('venue');
Route::post('venue/post', [HomeController::class, 'venuePost'])->name('venue.post');
Route::get('venue/edit/{id}', [HomeController::class, 'venueEdit'])->name('venue.edit');
Route::post('venue/edit/post', [HomeController::class, 'venueEditPost'])->name('venue.edit.post');

Route::get('events', [EventController::class, 'events'])->name('events');
Route::get('add/event', [EventController::class, 'addEvent'])->name('add.event');
Route::post('event/post', [EventController::class, 'eventPost'])->name('event.post');
Route::get('event/edit/{id}', [EventController::class, 'editEvent'])->name('event.edit');
Route::post('event/edit/post', [EventController::class, 'eventEditPost'])->name('event.edit.post');

Route::post('search/post', [EventController::class, 'searchPost'])->name('search.post');
