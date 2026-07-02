<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\OwnerController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\PriceController;
use App\Http\Controllers\AvailabilityController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\PaymentController;

Route::get('/', [HomeController::class, 'index']);

// Customer routes
Route::middleware(['auth'])->group(function () {
    Route::get('/customer/dashboard', [CustomerController::class, 'index'])
        ->name('customer.dashboard');
    Route::get('/booking/create', [BookingController::class, 'create'])
        ->name('booking.create');
    Route::post('/booking/store', [BookingController::class, 'store'])
        ->name('booking.store');
    Route::get('/feedback/create', [FeedbackController::class, 'create'])
        ->name('feedback.create');
    Route::post('/feedback/store', [FeedbackController::class, 'store'])
        ->name('feedback.store');
    Route::post('/booking/{id}/cancel', [BookingController::class, 'cancel'])
        ->name('booking.cancel');
    Route::get('/payment/{id}', [PaymentController::class, 'show'])
        ->name('payment.show');
    Route::post('/payment/{id}/process', [PaymentController::class, 'process'])
        ->name('payment.process');
    Route::get('/payment/{id}/success', [PaymentController::class, 'success'])
        ->name('payment.success');
});

// Owner routes
Route::middleware(['auth'])->group(function () {
    Route::get('/owner/dashboard', [OwnerController::class, 'index'])
        ->name('owner.dashboard');
    Route::get('/owner/bookings', [OwnerController::class, 'bookings'])
        ->name('owner.bookings');
    Route::post('/owner/bookings/{id}/approve', [OwnerController::class, 'approve'])
        ->name('owner.bookings.approve');
    Route::post('/owner/bookings/{id}/cancel', [OwnerController::class, 'cancel'])
        ->name('owner.bookings.cancel');
    Route::get('/owner/feedback', [FeedbackController::class, 'index'])
        ->name('owner.feedback');
    Route::post('/owner/feedback/{id}/resolve', [FeedbackController::class, 'resolve'])
        ->name('owner.feedback.resolve');
    Route::get('/owner/price', [PriceController::class, 'index'])
        ->name('owner.price');
    Route::post('/owner/price', [PriceController::class, 'update'])
        ->name('owner.price.update');
    Route::get('/owner/availability', [AvailabilityController::class, 'index'])
        ->name('owner.availability');
    Route::post('/owner/availability', [AvailabilityController::class, 'store'])
        ->name('owner.availability.store');
    Route::delete('/owner/availability/{id}', [AvailabilityController::class, 'destroy'])
        ->name('owner.availability.destroy');
    Route::get('/owner/report', [ReportController::class, 'index'])
        ->name('owner.report');
});

require __DIR__.'/auth.php';
