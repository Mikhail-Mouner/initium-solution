<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

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

Auth::routes();

// Middleware auth
Route::middleware( 'auth' )->group( function () {
    // Home Page
    Route::get( '/', [ HomeController::class, 'index' ] )->name( 'home' );
    Route::post( '/', [ HomeController::class, 'home_submit' ] )->name( 'home_submit' );
    //Route::get('/{slug}/branches/{id}', [HotelController::class, 'rooms'])->name('hotel_branch');
    //Route::get('/{slug}/branches/{id}/rooms', [HotelController::class, 'rooms'])->name('hotel_branch_rooms');
} );
