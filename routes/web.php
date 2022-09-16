<?php

use App\Http\Controllers\AlbumController;
use App\Http\Controllers\CardController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
    ]);
});

Route::get('/album/{album}/missing-cards', [AlbumController::class, 'missingCards'])->name('album.missing-cards');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {

    // Albums
    Route::get('/dashboard', [AlbumController::class, 'index'])->name('dashboard');
    Route::post('/album', [AlbumController::class, 'store'])->name('album.store');
    Route::get('/album/create', [AlbumController::class, 'create'])->name('album.create');
    Route::get('/album/{album}', [AlbumController::class, 'show'])->name('album.show');
    Route::get('/album/{album}/edit', [AlbumController::class, 'edit'])->name('album.edit');

    Route::patch('/album/{album}/add-user', [AlbumController::class, 'addUser'])->name('album.add-user');
    Route::patch('/album/{album}/remove-user/{user}', [AlbumController::class, 'removeUser'])->name('album.remove-user');

    Route::get('/album/{album}/edit-cards', [AlbumController::class, 'editCards'])->name('album.edit-cards');
    Route::get('/album/{album}/edit-cards/confirmation', [AlbumController::class, 'editCardsConfirmation'])->name('album.edit-cards-confirmation');
    Route::patch('/album/{album}/add-cards-quantity', [AlbumController::class, 'addCardsQuantity'])->name('album.add-cards-quantity');
    Route::patch('/album/{album}/subtract-cards-quantity', [AlbumController::class, 'subtractCardsQuantity'])->name('album.subtract-cards-quantity');

    //Cards
    Route::patch('/card/{card}/add-quantity', [CardController::class, 'add'])->name('card.add-quantity');
    Route::patch('/card/{card}/subtract-quantity', [CardController::class, 'subtract'])->name('card.subtract-quantity');

});
