<?php

// routes/web.php
// routes/web.php
// routes/web.php
use App\Http\Controllers\ItemController;
use App\Http\Controllers\ContactController;
use App\Models\Item;
use App\Http\Controllers\Admin\MessageController;

Route::get('/', function () {
    $recentItems = Item::latest()->take(5)->get();
    return view('home', compact('recentItems'));
})->name('home');

Route::resource('items', ItemController::class);
Route::resource('contacts', ContactController::class);

Route::middleware(['auth', 'is_admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/messages', [MessageController::class, 'index'])->name('messages.index');
    Route::get('/messages/{id}', [MessageController::class, 'show'])->name('messages.show');
});