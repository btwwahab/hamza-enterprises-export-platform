<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\BrandController as AdminBrandController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\EventController as AdminEventController;
use App\Http\Controllers\Admin\FaqController as AdminFaqController;
use App\Http\Controllers\Admin\InquiryController as AdminInquiryController;
use App\Http\Controllers\Admin\MachineryController as AdminMachineryController;
use App\Http\Controllers\Admin\NewsletterController as AdminNewsletterController;
use App\Http\Controllers\Admin\PartController as AdminPartController;
use App\Http\Controllers\Admin\SettingController as AdminSettingController;
use App\Http\Controllers\Admin\TestimonialController as AdminTestimonialController;
use App\Http\Controllers\Admin\VehicleController as AdminVehicleController;
use App\Http\Controllers\Admin\VideoController as AdminVideoController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InquiryController;
use App\Http\Controllers\MachineryController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\PartController;
use App\Http\Controllers\VehicleController;
use Illuminate\Support\Facades\Route;

// Public site
Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/cars', [VehicleController::class, 'index'])->name('cars');
Route::get('/car-detail', [VehicleController::class, 'show'])->name('car-detail');
Route::get('/machinery', [MachineryController::class, 'index'])->name('machinery');
Route::get('/machinery-detail', [MachineryController::class, 'show'])->name('machinery-detail');
Route::get('/parts', [PartController::class, 'index'])->name('parts');
Route::get('/part-detail', [PartController::class, 'show'])->name('part-detail');
Route::get('/events', [EventController::class, 'index'])->name('events');
Route::get('/event-detail', [EventController::class, 'show'])->name('event-detail');
Route::view('/about-us', 'pages.about-us')->name('about');
Route::get('/faq', [FaqController::class, 'index'])->name('faq');
Route::view('/contact-us', 'pages.contact-us')->name('contact');
Route::post('/contact-us', [InquiryController::class, 'store'])->name('inquiries.store');
Route::post('/newsletter', [NewsletterController::class, 'store'])->name('newsletter.store');
Route::view('/claim-center', 'pages.claim-center')->name('claim-center');
Route::view('/privacy-policy', 'pages.privacy-policy')->name('privacy-policy');
Route::view('/terms-conditions', 'pages.terms-conditions')->name('terms-conditions');
Route::view('/sitemap', 'pages.sitemap')->name('sitemap');

// Admin panel
Route::prefix('admin')->name('admin.')->group(function () {
    // Auth (public)
    Route::get('/', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.attempt');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Protected
    Route::middleware('auth')->group(function () {
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

        Route::get('/vehicles', [AdminVehicleController::class, 'index'])->name('vehicles');
        Route::get('/vehicles-form', [AdminVehicleController::class, 'form'])->name('vehicles.form');
        Route::get('/vehicles-export', [AdminVehicleController::class, 'export'])->name('vehicles.export');
        Route::post('/vehicles', [AdminVehicleController::class, 'store'])->name('vehicles.store');
        Route::put('/vehicles/{vehicle}', [AdminVehicleController::class, 'update'])->name('vehicles.update');
        Route::delete('/vehicles/{vehicle}', [AdminVehicleController::class, 'destroy'])->name('vehicles.destroy');

        Route::get('/machinery', [AdminMachineryController::class, 'index'])->name('machinery');
        Route::get('/machinery-form', [AdminMachineryController::class, 'form'])->name('machinery.form');
        Route::get('/machinery-export', [AdminMachineryController::class, 'export'])->name('machinery.export');
        Route::post('/machinery', [AdminMachineryController::class, 'store'])->name('machinery.store');
        Route::put('/machinery/{machinery}', [AdminMachineryController::class, 'update'])->name('machinery.update');
        Route::delete('/machinery/{machinery}', [AdminMachineryController::class, 'destroy'])->name('machinery.destroy');

        Route::get('/events', [AdminEventController::class, 'index'])->name('events');
        Route::get('/events-form', [AdminEventController::class, 'form'])->name('events.form');
        Route::post('/events', [AdminEventController::class, 'store'])->name('events.store');
        Route::put('/events/{event}', [AdminEventController::class, 'update'])->name('events.update');
        Route::delete('/events/{event}', [AdminEventController::class, 'destroy'])->name('events.destroy');

        Route::get('/parts', [AdminPartController::class, 'index'])->name('parts');
        Route::get('/parts-form', [AdminPartController::class, 'form'])->name('parts.form');
        Route::get('/parts-export', [AdminPartController::class, 'export'])->name('parts.export');
        Route::post('/parts', [AdminPartController::class, 'store'])->name('parts.store');
        Route::put('/parts/{part}', [AdminPartController::class, 'update'])->name('parts.update');
        Route::delete('/parts/{part}', [AdminPartController::class, 'destroy'])->name('parts.destroy');

        Route::get('/brands', [AdminBrandController::class, 'index'])->name('brands');
        Route::post('/brands', [AdminBrandController::class, 'sync'])->name('brands.sync');
        Route::get('/testimonials', [AdminTestimonialController::class, 'index'])->name('testimonials');
        Route::get('/testimonials-form', [AdminTestimonialController::class, 'form'])->name('testimonials.form');
        Route::post('/testimonials', [AdminTestimonialController::class, 'store'])->name('testimonials.store');
        Route::put('/testimonials/{testimonial}', [AdminTestimonialController::class, 'update'])->name('testimonials.update');
        Route::delete('/testimonials/{testimonial}', [AdminTestimonialController::class, 'destroy'])->name('testimonials.destroy');
        Route::get('/faq', [AdminFaqController::class, 'index'])->name('faq');
        Route::get('/faq-form', [AdminFaqController::class, 'form'])->name('faq.form');
        Route::post('/faq', [AdminFaqController::class, 'store'])->name('faq.store');
        Route::put('/faq/{faq}', [AdminFaqController::class, 'update'])->name('faq.update');
        Route::delete('/faq/{faq}', [AdminFaqController::class, 'destroy'])->name('faq.destroy');
        Route::get('/inquiries', [AdminInquiryController::class, 'index'])->name('inquiries');
        Route::patch('/inquiries/{inquiry}', [AdminInquiryController::class, 'updateStatus'])->name('inquiries.update-status');
        Route::delete('/inquiries/{inquiry}', [AdminInquiryController::class, 'destroy'])->name('inquiries.destroy');
        Route::get('/settings', [AdminSettingController::class, 'edit'])->name('settings');
        Route::post('/settings/hero', [AdminSettingController::class, 'updateHero'])->name('settings.hero');
        Route::post('/settings/company', [AdminSettingController::class, 'updateCompany'])->name('settings.company');
        Route::post('/settings/showrooms', [AdminSettingController::class, 'updateShowrooms'])->name('settings.showrooms');
        Route::post('/settings/leadership', [AdminSettingController::class, 'updateLeadership'])->name('settings.leadership');

        Route::get('/newsletter', [AdminNewsletterController::class, 'index'])->name('newsletter');
        Route::delete('/newsletter/{subscriber}', [AdminNewsletterController::class, 'destroy'])->name('newsletter.destroy');

        Route::get('/videos', [AdminVideoController::class, 'index'])->name('videos');
        Route::get('/videos-form', [AdminVideoController::class, 'form'])->name('videos.form');
        Route::post('/videos', [AdminVideoController::class, 'store'])->name('videos.store');
        Route::put('/videos/{video}', [AdminVideoController::class, 'update'])->name('videos.update');
        Route::delete('/videos/{video}', [AdminVideoController::class, 'destroy'])->name('videos.destroy');
    });
});
