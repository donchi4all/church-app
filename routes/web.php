<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DonationController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PartnershipController;
use App\Http\Controllers\PrayerRequestController;
use App\Http\Controllers\SeoController;
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

Route::get('/q', function () {
    return view('frontend.index');
});

Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/ministry', [PageController::class, 'ministry'])->name('ministry');
Route::get('/contact', [PageController::class, 'contact'])->name('contact');
 Route::get('/sermon-single', [PageController::class, 'sermonSingle'])->name('sermon.single');
Route::get('/prayer-form', [PageController::class, 'prayerForm'])->name('prayer.form');
Route::get('/partnership', [PageController::class, 'partnership'])->name('partnership');
Route::get('/donation', [PageController::class, 'donation'])->name('donation');

Route::post('/contacts', [ContactController::class, 'store'])->name('contact.store');
Route::post('/partnership', [PartnershipController::class, 'store'])->name('partnership.store');
Route::post('/prayer', [PrayerRequestController::class, 'store'])->name('prayer.store');


Route::post('donate/paystack', [DonationController::class, 'payWithPaystack'])->name('donate.paystack');
Route::get('donate/paystack/callback', [DonationController::class, 'paystackCallback'])->name('donate.paystack.callback');

Route::post('donate/paypal', [DonationController::class, 'payWithPayPal'])->name('donate.paypal');
Route::get('/donation/paypal/callback', [DonationController::class, 'handlePaypalCallback'])->name('paypal.callback');
Route::get('/donation/paypal/cancel', [DonationController::class, 'paypalCancel'])->name('paypal.cancel');


// Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
// Route::get('/login', [AdminController::class, 'login'])->name(name: 'login');
// Route::get('/settings', [AdminController::class, 'login'])->name('settings');
// Route::post('/form-submit', [AdminController::class, 'submitForm'])->name('form.submit');


// Admin Authentication Routes
Route::prefix('admin')->group(function () {
    // Routes for guests (admin login)
    Route::middleware('guest:admin')->group(function () {
        Route::get('login', [AuthController::class, 'showLoginForm'])->name('admin.login');
        Route::post('login', [AuthController::class, 'login'])->name('admin.login.submit');
    });

    // Routes for authenticated admin users
    Route::middleware('auth:admin')->group(function () {
        Route::get('dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
        Route::get('users', [DashboardController::class, 'manageUsers'])->name('admin.users');
        Route::post('settings', [DashboardController::class, 'settings'])->name('admin.settings');
        Route::get('logout', [AuthController::class, 'logout'])->name('admin.logout');

        Route::get('donations', [DonationController::class, 'listDonations'])->name('admin.donations.list');
        Route::get('prayer-requests', [PrayerRequestController::class, 'listPrayerRequest'])->name('admin.prayer.request.list');
        Route::get('partnerships', [PartnershipController::class, 'listPartnership'])->name('admin.partnership');
        Route::get('contacts', [ContactController::class, 'listContacts'])->name('admin.contacts.list');

        Route::prefix('settings')->group(function () {
            Route::get('heroes', [DashboardController::class, 'listHero'])->name('admin.setting.hero.list');
            Route::put('heroes/{id}', [DashboardController::class, 'updateHero'])->name('admin.setting.hero.update');

            Route::get('recent-sermons', [DashboardController::class, 'listRecentSermon'])->name('admin.setting.recent.list');
            Route::post('recent-sermons', [DashboardController::class, 'storeRecentSermon'])->name('admin.setting.recent.store');
            Route::put('recent-sermons/{id}', [DashboardController::class, 'updateRecentSermon'])->name('admin.setting.recent.update');
            Route::delete('recent-sermons/{id}', [DashboardController::class, 'destroyRecentSermon'])->name('admin.setting.recent.destroy');

            Route::get('upcoming-sermons', [DashboardController::class, 'listUpcomingSermon'])->name('admin.setting.upcoming.list');
            Route::post('/admin/upcoming-sermon/update', [DashboardController::class, 'updateUpcomingSermon'])->name('admin.upcoming-sermon.update');


            Route::get('about-us', [DashboardController::class, 'listAboutUs'])->name('admin.setting.about.list');
            Route::post('about-us', [DashboardController::class, 'updateAboutUs'])->name('admin.setting.about.update');

            Route::prefix('testimonials')->name('admin.setting.testimony.')->group(function () {
                Route::get('/', [DashboardController::class, 'listTestimony'])->name('list');
                Route::post('/', [DashboardController::class, 'storeTestimony'])->name('store');
                Route::put('{testimonial}', [DashboardController::class, 'updateTestimony'])->name('update');
                Route::delete('{testimonial}', [DashboardController::class, 'destroyTestimony'])->name('destroy');
            });

            Route::resource('seo', SeoController::class);
            // Route::get('seo', [DashboardController::class, 'ed'])->name('admin.setting.upcoming.list');


        });
    });
});

// Contact routes
// Route::get('/contacts', [ContactController::class, 'index'])->name('contact.index');
