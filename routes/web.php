<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminSiteController;


Route::get('/', [SiteController::class, 'home'])->name('getHome');
Route::get('/rooms', [SiteController::class, 'rooms'])->name('getRooms');
Route::get('/about-us', [SiteController::class, 'aboutUs'])->name('getAboutUs');
Route::get('/gallery', [SiteController::class, 'gallery'])->name('getGallery');
Route::get('/contact-us', [SiteController::class, 'contactUs'])->name('getContactUs');
Route::get('/roomDetail/{slug}', [SiteController::class, 'roomDetail'])->name('getRoomDetails');


// User Add

Route::post('/post/pre-booking/{id}', [HomeController::class, 'postAddPreBooking'])->name('postPreBooking');
Route::post('/post/check-availiability', [HomeController::class, 'postAddCheckAvailability'])->name('postCheckAvailability');

Route::get('/admin', function() {
    return back(); 
});

Route::get('/register', function() {
    if(!(auth()->check()))
    {
        return back(); 
    }
    return view('auth.register');
});





Route::middleware('auth')->group(function() {

    // Admin
    Route::get('/admin/home', [AdminSiteController::class, 'adminHome'])->name('getAdminHome');
    Route::get('/admin/maps', [AdminSiteController::class, 'adminMaps'])->name('getAdminMaps');
    Route::get('/admin/rooms', [AdminSiteController::class, 'adminRooms'])->name('getAdminRoom');
    Route::get('/admin/gallery', [AdminSiteController::class, 'adminGallery'])->name('getAdminGallery');
    Route::get('/admin/contact-us', [AdminSiteController::class, 'adminContactUs'])->name('getAdminContactUs');
    Route::get('/admin/pre-booking', [AdminSiteController::class, 'adminPreBooking'])->name('getAdminPreBooking');
    Route::get('/admin/checked-in', [AdminSiteController::class, 'adminCheckedIn'])->name('getAdminCheckedIn');
    Route::get('/admin/rooms/cancelled', [AdminSiteController::class, 'adminRoomCancelled'])->name('getAdminRoomCancelled');
    Route::get('/admin/getAdminBooked', [AdminSiteController::class, 'adminBooked'])->name('getAdminBooked');
    Route::get('/admin/search/pre-booking', [AdminSiteController::class, 'adminSearchPreBooking'])->name('getAdminSearchPreBooking');
    Route::get('/admin/search/booked', [AdminSiteController::class, 'adminSearchBooked'])->name('getAdminSearchBooked');
    Route::get('/admin/search/checked-in', [AdminSiteController::class, 'adminSearchCheckedIn'])->name('getAdminSearchCheckedIn');
    Route::get('/admin/search/cancelled-room', [AdminSiteController::class, 'adminSearchCancelledRooms'])->name('getAdminSearchCancelledRooms');


    // Admin Add
    Route::post('/post/maps', [AdminController::class, 'postMap'])->name('postMap');
    Route::post('/post/room', [AdminController::class, 'postRoom'])->name('postAddRoom');
    Route::post('/post/gallery', [AdminController::class, 'postGallery'])->name('postGalleryImage');
    Route::post('/contact-us', [AdminController::class, 'adminAddContactUs'])->name('getAdminAddContactUs');

    // Admin Delete
    Route::get('/gallery/delete/{id}', [AdminController::class, 'deleteGalleryImage'])->name('deleteGalleryImage');



    // Admin Edit Pre Booking
    Route::post('/preBooking/edit/{id}', [AdminController::class, 'editPreBooking'])->name('postEditPreBooking');
    Route::post('/booked/edit/{id}', [AdminController::class, 'editBooked'])->name('postEditBooked');

});


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';