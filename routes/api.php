<?php
use Illuminate\Support\Facades\Route;
use test186\HuntingBookingModule\Http\Controllers\{BookingController, GuideController, ServiceController};

Route::middleware('json.response')->group(function () {
    Route::put('guide', [GuideController::class, 'createItem']);
    Route::get('guide', [GuideController::class, 'getList']);
    Route::put('booking', [BookingController::class, 'createItem']);
    Route::get('booking', [BookingController::class, 'getList']);
    Route::put('service', [ServiceController::class, 'createItem']);
    Route::get('service', [ServiceController::class, 'getList']);
});