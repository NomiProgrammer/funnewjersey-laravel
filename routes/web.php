<?php

use Illuminate\Support\Facades\Route;
// Breeze Package Includes (Start)
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;
// Breeze Package Includes (End)
// Admin Includes (Start)
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PackagesController;
use App\Http\Controllers\Admin\PagesController;
use App\Http\Controllers\Admin\BlogArticleController;
use App\Http\Controllers\Admin\ParallaxController;
use App\Http\Controllers\Admin\BannersAdsController;
use App\Http\Controllers\Admin\InvoicesController;
use App\Http\Controllers\Admin\ProductsController;
use App\Http\Controllers\Admin\WidgetsController;
use App\Http\Controllers\Admin\TagsController;
use App\Http\Controllers\Admin\CategoryController;
// Admin Includes (End)




Route::group(['prefix' => '{locale}', 'where' => ['locale' => 'en|es|fr|ur']], function () {
    // Breeze Authentication Routes
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->middleware(['auth', 'verified'])->name('dashboard');

    Route::middleware('auth')->group(function () {
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });
    Route::middleware('guest')->group(function () {
        Route::get('register', [RegisteredUserController::class, 'create'])
            ->name('register');
        Route::post('register', [RegisteredUserController::class, 'store']);
        Route::get('login', [AuthenticatedSessionController::class, 'create'])
            ->name('login');
        Route::post('login', [AuthenticatedSessionController::class, 'store']);
        Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
            ->name('password.request');
        Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
            ->name('password.email');
        Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
            ->name('password.reset');
        Route::post('reset-password', [NewPasswordController::class, 'store'])
            ->name('password.store');
    });
    Route::middleware('auth')->group(function () {
        Route::get('verify-email', EmailVerificationPromptController::class)
            ->name('verification.notice');
        Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
            ->middleware(['signed', 'throttle:6,1'])
            ->name('verification.verify');
        Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
            ->middleware('throttle:6,1')
            ->name('verification.send');
        Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
            ->name('password.confirm');
        Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);
        Route::put('password', [PasswordController::class, 'update'])->name('password.update');
        Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
            ->name('logout');
    });
    // Breeze Authentication Routes





    // Our Routes Will Be here


    /*
    |--------------------------------------------------------------------------
    | Front dashboard Routes(Start)
    |--------------------------------------------------------------------------
    */

    Route::get('/', function () {
        return view('welcome');
    });


    /*
    |--------------------------------------------------------------------------
    | Front dashboard Routes(end)
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | Admin dashboard Routes(Start)
    |--------------------------------------------------------------------------
    */

    Route::prefix('/admin')->group(function () {
        // Dashboard
        Route::get('/home', [DashboardController::class, 'index'])
            ->name('admin.dashboard');
        //Base Routes
        Route::get('/create', [DashboardController::class, 'create'])
            ->name('base.create');
        Route::get('/index', [DashboardController::class, 'manage'])
            ->name('base.index');
        // Parallax Slider
        Route::controller(ParallaxController::class)->group(function () {
            Route::get('/parallax/manage/', 'index')->name('parallax.index');
            Route::get('/parallax/add/', 'create')->name('parallax.create');
            Route::post('/parallax/store/', 'store')->name('parallax.store');
            Route::get('/parallax/edit//{id}', 'edit')->name('parallax.edit');
            Route::put('/parallax/update//{id}', 'update')->name('parallax.update');
            Route::delete('/parallax/destroy//{id}', 'destroy')->name('parallax.destroy');
        });
        // BannerAds Slider
        Route::controller(BannersAdsController::class)->group(function () {
        Route::get('/banners-ads/manage', 'index')->name('bannersads.index');
        });
        // Invoice Controller
        Route::controller(InvoicesController::class)->group(function () {
        Route::get('/invoices/manage', 'index')->name('invoice.index');
        });
        // Category Controller
        Route::controller(CategoryController::class)->group(function () {
        Route::get('/category/manage', 'index')->name('category.index');
        });
        // Tags Controller
        Route::controller(TagsController::class)->group(function () {
        Route::get('/tags/manage', 'index')->name('tags.index');
        });
        // Package Controller
        Route::controller(PackagesController::class)->group(function () {
        Route::get('/packages/manage', 'index')->name('package.index');
        });
        // BlogArticleController Controller
        Route::controller(BlogArticleController::class)->group(function () {
        Route::get('/blog/manage', 'index')->name('blog.index');
        });
        // PageController Controller
        Route::controller(PagesController::class)->group(function () {
        Route::get('/pages/manage', 'index')->name('pages.index');
        });
        // Widgets Controller
        Route::controller(WidgetsController::class)->group(function () {
        Route::get('/widgets/manage', 'index')->name('widgets.index');
        });
    });






    /*
    |--------------------------------------------------------------------------
    | Admin dashboard Routes(end)
    |--------------------------------------------------------------------------
    */


    //End Of Our Routes
});
