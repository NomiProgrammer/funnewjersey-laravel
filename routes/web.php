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
use App\Http\Controllers\Admin\MegaMenusTagsController;
use App\Http\Controllers\Admin\ListingController;
// Admin Includes (End)



Route::group(['prefix' => '{locale}', 'where' => ['locale' => 'en|es|fr|ur']], function () {
    // ✅ Breeze Auth Routes inside locale group
    require __DIR__.'/auth.php';
    // Breeze Authentication Routes
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->middleware(['auth', 'verified'])->name('dashboard');


    // Our Routes Will Be here


    /*
    |--------------------------------------------------------------------------
    | Front dashboard Routes(Start)
    |--------------------------------------------------------------------------
    */

    // Route::get('/', function () {
    //     return view('welcome');
    // });


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
        Route::get('/', [DashboardController::class, 'index'])
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
            Route::get('/parallax/edit/{id}', 'edit')->name('parallax.edit');
            Route::put('/parallax/update/{id}', 'update')->name('parallax.update');
            Route::delete('/parallax/destroy/{id}', 'destroy')->name('parallax.destroy');
        });
        // BannerAds Slider
        Route::controller(BannersAdsController::class)->group(function () {
        Route::get('/banners-ads/manage', 'index')->name('bannersads.index');
        Route::get('/banners-ads/add/', 'create')->name('banners-ads.create');
        Route::post('/banners-ads/store/', 'store')->name('banners-ads.store');
        Route::get('/banners-ads/edit/{id}', 'edit')->name('banners-ads.edit');
        Route::put('/banners-ads/update/{id}', 'update')->name('banners-ads.update');
        Route::delete('/banners-ads/destroy/{id}', 'destroy')->name('banners-ads.destroy');
        });
        // Invoice Controller
        Route::controller(InvoicesController::class)->group(function () {
        Route::get('/invoices/manage', 'index')->name('invoices.index');
        Route::get('/invoices/add/', 'create')->name('invoices.create');
        Route::post('/invoices/store/', 'store')->name('invoices.store');
        Route::get('/invoices/edit/{id}', 'edit')->name('invoices.edit');
        Route::put('/invoices/update/{id}', 'update')->name('invoices.update');
        Route::delete('/invoices/destroy/{id}', 'destroy')->name('invoices.destroy');
        });
        // Category Controller
        Route::controller(CategoryController::class)->group(function () {
        Route::get('/category/manage', 'index')->name('category.index');
        Route::get('/category/add', 'create')->name('category.create');
        Route::post('/category/store', 'store')->name('category.store');
        Route::get('/category/edit/{id}', 'edit')->name('category.edit');
        Route::put('/category/update/{id}', 'update')->name('category.update');
        Route::delete('/category/destroy/{id}', 'destroy')->name('category.destroy');
        });
        // Tags Controller
        Route::controller(TagsController::class)->group(function () {
        Route::get('/tags/manage', 'index')->name('tags.index');
        Route::get('/tags/add/', 'create')->name('tags.create');
        Route::post('/tags/store/', 'store')->name('tags.store');
        Route::get('/tags/edit/{id}', 'edit')->name('tags.edit');
        Route::put('/tags/update/{id}', 'update')->name('tags.update');
        Route::delete('/tags/destroy/{id}', 'destroy')->name('tags.destroy');
        });
        // Package Controller
        Route::controller(PackagesController::class)->group(function () {
        Route::get('/packages/manage', 'index')->name('package.index');
        Route::get('/package/add', 'create')->name('package.create');
        Route::post('/package/store', 'store')->name('package.store');
        Route::get('/package/edit/{id}', 'edit')->name('package.edit');
        Route::put('/package/update/{id}', 'update')->name('package.update');
        Route::delete('/package/destroy/{id}', 'destroy')->name('package.destroy');
        });
        // BlogArticleController Controller
        Route::controller(BlogArticleController::class)->group(function () {
        Route::get('/blog/manage', 'index')->name('blog.index');
        Route::get('/blog/add', 'create')->name('blog.create');
        Route::post('/blog/store', 'store')->name('blog.store');
        Route::get('/blog/edit/{id}', 'edit')->name('blog.edit');
        Route::put('/blog/update/{id}', 'update')->name('blog.update');
        Route::delete('/blog/destroy/{id}', 'destroy')->name('blog.destroy');
        });
        // PageController Controller
        Route::controller(PagesController::class)->group(function () {
        Route::get('/pages/manage', 'index')->name('pages.index');
        Route::get('/pages/add', 'create')->name('pages.create');
        Route::post('/pages/store', 'store')->name('pages.store');
        Route::get('/pages/edit/{id}', 'edit')->name('pages.edit');
        Route::put('/pages/update/{id}', 'update')->name('pages.update');
        Route::delete('/pages/destroy/{id}', 'destroy')->name('pages.destroy');
        });
        // Widgets Controller
        Route::controller(WidgetsController::class)->group(function () {
        Route::get('/widgets/manage', 'index')->name('widgets.index');
        Route::get('/widgets/add', 'create')->name('widgets.create');
        Route::post('/widgets/store', 'store')->name('widgets.store');
        Route::get('/widgets/edit/{id}', 'edit')->name('widgets.edit');
        Route::put('/widgets/update/{id}', 'update')->name('widgets.update');
        Route::delete('/widgets/destroy/{id}', 'destroy')->name('widgets.destroy');
        });
        // MegaMenusTag Controller
        Route::controller(MegaMenusTagsController::class)->group(function () {
        Route::get('/meta_tags/manage', 'index')->name('meta_tags.index');
        Route::get('/meta_tags/add', 'create')->name('meta_tags.create');
        Route::post('/meta_tags/store', 'store')->name('meta_tags.store');
        Route::get('/meta_tags/edit/{id}', 'edit')->name('meta_tags.edit');
        Route::put('/meta_tags/update/{id}', 'update')->name('meta_tags.update');
        Route::delete('/meta_tags/destroy/{id}', 'destroy')->name('meta_tags.destroy');
        });
        // Listing Controller
        Route::controller(ListingController::class)->group(function () {
        Route::get('/listings/manage', 'index')->name('listings.index');
        Route::get('/listings/add', 'create')->name('listings.create');
        Route::post('/listings/store', 'store')->name('listings.store');
        Route::get('/listings/edit/{id}', 'edit')->name('listings.edit');
        Route::put('/listings/update/{id}', 'update')->name('listings.update');
        Route::delete('/listings/destroy/{id}', 'destroy')->name('listings.destroy');
        });
    });






    /*
    |--------------------------------------------------------------------------
    | Admin dashboard Routes(end)
    |--------------------------------------------------------------------------
    */


    //End Of Our Routes
});
