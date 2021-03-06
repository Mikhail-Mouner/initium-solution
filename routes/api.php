<?php

use App\Http\Controllers\Api\HotelController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('api')->group(function () {
    // Home Page
    Route::get('/{slug}/branches', [HotelController::class, 'index'])->name('hotel_branches');
    Route::post( '/home-submit', [ HotelController::class, 'homeSubmit' ] )->name( 'home_submit' );
});
