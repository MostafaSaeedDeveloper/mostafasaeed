<?php

use App\Http\Controllers\Admin\ClientController;
use App\Http\Controllers\Admin\ContactMessageController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ExpenseController;
use App\Http\Controllers\Admin\InvoiceController;
use App\Http\Controllers\Admin\PaymentController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\RevenueController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\FrontendController;
use App\Services\LocalizationService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/lang/{locale}', function (string $locale, LocalizationService $localizationService) {
    $localizationService->setLocale($locale);

    return back();
})->name('lang.switch');

Route::get('/', [FrontendController::class, 'home'])->name('home');
Route::get('/about', [FrontendController::class, 'about'])->name('about');
Route::get('/services', [FrontendController::class, 'services'])->name('services');
Route::get('/projects', [FrontendController::class, 'projects'])->name('projects');
Route::get('/projects/{slug}', [FrontendController::class, 'projectShow'])->name('projects.show');
Route::get('/clients', [FrontendController::class, 'clients'])->name('clients');
Route::get('/contact', [FrontendController::class, 'contact'])->name('contact');
Route::post('/contact', [FrontendController::class, 'storeContact'])
    ->middleware('throttle:10,1')
    ->name('contact.store');
Route::get('/sitemap.xml', [FrontendController::class, 'sitemap'])->name('sitemap');

Auth::routes(['register' => false]);

Route::prefix('dashboard')
    ->name('admin.')
    ->middleware(['auth', 'role:Owner|Content Manager|Accountant|CRM Manager'])
    ->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::resource('/services', ServiceController::class);
        Route::resource('/projects', ProjectController::class);
        Route::resource('/clients', ClientController::class);
        Route::resource('/customers', CustomerController::class);
        Route::resource('/invoices', InvoiceController::class);
        Route::resource('/payments', PaymentController::class);
        Route::resource('/expenses', ExpenseController::class);
        Route::resource('/revenues', RevenueController::class);
        Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
        Route::patch('/messages/{message}/status', [ContactMessageController::class, 'updateStatus'])->name('messages.update-status');
        Route::get('/settings', [SettingController::class, 'edit'])->name('settings.edit');
        Route::put('/settings', [SettingController::class, 'update'])->name('settings.update');
        Route::get('/messages', [ContactMessageController::class, 'index'])->name('messages.index');
        Route::get('/messages/{message}', [ContactMessageController::class, 'show'])->name('messages.show');
    });
