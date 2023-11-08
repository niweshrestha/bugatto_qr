<?php

use App\Http\Controllers\Admin\Auth\CustomAuthController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CodesController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\LotteryController;
// use App\Http\Controllers\QRCodeController;
use App\Http\Controllers\Web\CodesController as WebCodesController;
use App\Http\Controllers\Web\LandingController;
use App\Http\Controllers\Web\LotteryController as WebLotteryController;
use Illuminate\Support\Facades\Route;

Route::get('/', [DashboardController::class, 'index'])->name('admin.dashboard')->middleware('auth');

Route::group([
    'prefix' => '/admin-panel',
    'as' => 'admin.',
    'middleware' => ['auth']
], function() {
    // Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('signout', [DashboardController::class, 'signOut'])->name('signout');
    Route::controller(BrandController::class)->group(function() {
        Route::get('/brands/lists', 'lists')->name('brand.lists');
        Route::match(['get', 'post'], '/brands/create', 'create')->name('brand.generate');
        Route::match(['get', 'post'], '/brands/update/{id}', 'update')->name('brand.update');
        Route::get('/view-brand/{brandId}', 'show')->name('brand.show');
    });
    Route::controller(CodesController::class)->group(function() {
        Route::match(['get', 'post'], '/codes/lists', 'lists')->name('code.lists');
        Route::match(['get', 'post'], '/codes/import', 'generate')->name('code.generate');
        Route::match(['get', 'post'], '/codes/each', 'generateEach')->name('code.generate.each');
        Route::get('/view-code/{codeId}', 'show')->name('code.show');
        Route::get('/download-zip/{brandId?}', 'zipDownload')->name('code.zip.download');
        Route::get('/download/{filename}', 'fileDownload')->name('file.download');
        Route::get('/export/{brandId?}', 'exportToExcel')->name('code.export');
    });
    Route::controller(LotteryController::class)->group(function() {
        Route::get('/lotteries/lists', 'lists')->name('lottery.lists');
        Route::match(['get', 'post'], '/lotteries/create', 'create')->name('lottery.create');
        Route::match(['get', 'post'], '/lotteries/update/{id}', 'update')->name('lottery.update');
        Route::get('/change-status/{id}', 'changeStatus')->name('lottery.change.status');
        Route::delete('/delete/{id}', 'delete')->name('lottery.delete');
        Route::get('/lottery/applicants/{id}', 'applicants')->name('lottery.applicants');
        Route::post('/lottery/applicants/winner/{id}', 'selectWinner')->name('lottery.applicant.winner');
        Route::post('/lottery/applicants/random-winner/{lotteryId}', 'randomWinner')->name('lottery.applicant.random.winner');
    });
});

Route::match(['get', 'post'], 'login', [CustomAuthController::class, 'login'])->name('login')->middleware('guest');

Route::group([
    'as' => 'web.'
], function() {   
    Route::controller(LandingController::class)->group(function() {
        // Route::get('/', 'landing')->name('landing');
        // Route::view('/#contact', 'web/pages/front')->name('contact');
        Route::post('/lottery/{id}/join', 'joinLottery')->name('applicant.join');
    });
    Route::controller(WebCodesController::class)->group(function() {
        Route::get('/{brand?}/{security_no?}', 'verify')->name('verify.product');
    });
    Route::controller(WebLotteryController::class)->group(function() {
        Route::get('/b/lottery/{name}', 'view')->name('brand.lottery');
        // Route::post('/lottery/{id}/join', 'joinLottery')->name('applicant.join');
    });
});