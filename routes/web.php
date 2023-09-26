<?php

use App\Livewire\Admin\Page\Confirm;
use App\Livewire\Home;
use App\Livewire\User\Page\Create;
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

Route::get('/', function () {
    return view('home');
});

Route::prefix('event')->group(function () {
    Route::get('create', Create::class)->name('event.create');
});

Route::prefix('admin')->group(function () {
    Route::get('map', Confirm::class)->name('admin.map');
});
