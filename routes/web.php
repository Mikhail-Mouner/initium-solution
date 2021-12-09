<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\HotelController;
use App\Http\Controllers\BookingController;

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
    Route::get( '/{slug}/branches/{id}/rooms/{type}', [ HotelController::class, 'hotelRooms' ] )->name( 'hotel_branch_rooms' );
    Route::post( '/add-to-cart', [ BookingController::class, 'addToCart' ] )->name( 'add_to_cart' );
    Route::post( '/remove-item-cart', [ BookingController::class, 'removeToCart' ] )->name( 'remove_item_cart' );
    Route::get( '/cart', [ BookingController::class, 'cart' ] )->name( 'cart' );
    Route::get( '/booking', [ BookingController::class, 'booking' ] )->name( 'booking' );
    Route::get( '/historical', [ BookingController::class, 'historical' ] )->name( 'historical' );
} );
