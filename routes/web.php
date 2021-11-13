<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;


Auth::routes();
$languageList = 'en|az|ru';
Route::get('/change-language/{language}', [App\Http\Controllers\LanguageController::class, 'change']);
// Route::get('/', [App\Http\Controllers\HomeController::class, 'index']);
Route::get('/', function () {
    return redirect((Session::get('language') ? Session::get('language') : '/az') . '/home');
});
Route::get('/home', function () {
    return redirect((Session::get('language') ? Session::get('language') : '/az') . '/home');
});


Route::group(
    ['prefix' => '/{lang}/', 'where' => ['lang' => $languageList], 'middleware' => 'setlocale'],
    function () {
        Route::get('/', [App\Http\Controllers\HomeController::class, 'index']);
        Route::get('/home', [App\Http\Controllers\HomeController::class, 'index']);
        Route::post('/home/order', [App\Http\Controllers\HomeController::class, 'homeOrder']);
        Route::get('/page/{url}', [App\Http\Controllers\PageController::class, 'index']);
        Route::get('/last', [App\Http\Controllers\HomeController::class, 'last']);
        Route::get('/vip', [App\Http\Controllers\HomeController::class, 'vip']);
        Route::get('/rent', [App\Http\Controllers\HomeController::class, 'rent']);
        Route::get('/object/{id}', [App\Http\Controllers\HomeController::class, 'object']);
        Route::get('/repair', [App\Http\Controllers\RepairController::class, 'index']);
        Route::get('/about', [App\Http\Controllers\AboutController::class, 'index']);
        // Route::get('/page/{url}', [App\Http\Controllers\StaticController::class, 'index']);
        Route::get('/ads', [App\Http\Controllers\AdsController::class, 'index'])->middleware('auth');
        Route::get('/place-ads', [App\Http\Controllers\PlaceAdsController::class, 'index'])->middleware('auth');
        Route::get('/choosed', [App\Http\Controllers\ChooseController::class, 'index']);
        Route::get('/selected/{id}', [App\Http\Controllers\ChooseController::class, 'add']);
        Route::get('/selected/remove/{id}', [App\Http\Controllers\ChooseController::class, 'remove']);
        Route::get('/compare', [App\Http\Controllers\CompareController::class, 'index']);
        Route::get('/compare/{id}', [App\Http\Controllers\CompareController::class, 'add']);
        Route::get('/compare/remove/{id}', [App\Http\Controllers\CompareController::class, 'remove']);
        Route::get('/faq', [App\Http\Controllers\FAQController::class, 'index']);
        Route::get('/agreement', [App\Http\Controllers\AgreementController::class, 'index']);
        Route::get('/agency', [App\Http\Controllers\AgencyController::class, 'index']);
        Route::get('/agency/{id}', [App\Http\Controllers\AgencyController::class, 'detail']);
        Route::get('/agency/{id}/{type}', [App\Http\Controllers\AgencyController::class, 'detail']);
        Route::get('/order-flat', [App\Http\Controllers\OrderFlatController::class, 'index'])->middleware('auth');
        Route::post('/order-flat', [App\Http\Controllers\OrderFlatController::class, 'index'])->middleware('auth');
        Route::get('/order-flat/sendmail', [App\Http\Controllers\OrderFlatController::class, 'sendemail']);
        Route::get('/rules', [App\Http\Controllers\RuleController::class, 'index']);
        Route::get('/makler', [App\Http\Controllers\MaklerController::class, 'index']);
        Route::get('/makler/{id}', [App\Http\Controllers\MaklerController::class, 'detail']);
        Route::get('/makler/{id}/{type}', [App\Http\Controllers\MaklerController::class, 'detail']);
        Route::get('/business-center', [App\Http\Controllers\BusinessCenterController::class, 'index']);
        Route::get('/residence', [App\Http\Controllers\ResidenceController::class, 'index']);
        Route::get('/residence/{id}', [App\Http\Controllers\ResidenceController::class, 'detail']);
        Route::get('/services/{slug}', [App\Http\Controllers\ServicesController::class, 'index']);


        Route::get('/profile', [App\Http\Controllers\ProfileController::class, 'index'])->middleware('auth');
        Route::get('/profile/announcements/{type?}', [App\Http\Controllers\ProfileController::class, 'announcements'])->middleware('auth');
        Route::get('/profile/balance', [App\Http\Controllers\ProfileController::class, 'balance'])->middleware('auth');
        Route::get('/profile/payments', [App\Http\Controllers\ProfileController::class, 'payments'])->middleware('auth');
        Route::get('/profile/orders', [App\Http\Controllers\ProfileController::class, 'orders'])->middleware('auth');
        Route::get('/profile/profile', [App\Http\Controllers\ProfileController::class, 'profile'])->middleware('auth');
        Route::post('/profile/add-order', [App\Http\Controllers\ProfileController::class, 'addOrder'])->middleware('auth');
        Route::post('/edit-profile-info', [App\Http\Controllers\ProfileController::class, 'editProfileDetail'])->middleware('auth');


        Route::get('/sale', [App\Http\Controllers\SaleController::class, 'index']);
        Route::get('/sale/{id}', [App\Http\Controllers\SaleController::class, 'index']);
        Route::get('/rent', [App\Http\Controllers\RentController::class, 'index']);
        Route::get('/rent/{id}', [App\Http\Controllers\RentController::class, 'index']);
        Route::get('/cron-promote', [App\Http\Controllers\CronController::class, 'promote']);

        Route::get('/login', 'App\Http\Controllers\Auth\LoginController@showLoginForm');
        Route::post('/login', 'App\Http\Controllers\Auth\LoginController@showLoginForm');

        Route::get('/register', [App\Http\Controllers\Auth\RegisterController::class, 'showRegistrationForm']);
        Route::post('/register', [App\Http\Controllers\Auth\RegisterController::class, 'showRegistrationForm']);

        Route::get('logout', function (Request $request) {
            Auth::logout();

            $request->session()->invalidate();

            $request->session()->regenerateToken();

            return redirect("/");
        });

    }
);
Route::post('/registerNew', [App\Http\Controllers\Auth\RegisterController::class, 'register']);
Route::get('/add-balance', [App\Http\Controllers\ProfileController::class, 'addBalance'])->middleware('auth');
Route::post('/add-balance', [App\Http\Controllers\ProfileController::class, 'addBalance'])->middleware('auth');

Route::get("/cache", function () {
    Artisan::call('cache:clear');
    return "Cache is cleared";
});
// Route::get('/selected/{id}', [App\Http\Controllers\HomeController::class, 'selected']);
// Route::get('/compare/{id}', [App\Http\Controllers\HomeController::class, 'compare']);

//Facebook login or register
Route::get('/facebookRedirect', [App\Http\Controllers\Auth\RegisterController::class, 'redirectToFacebook'])->name('facebook.redirect');
Route::get('/facebookCallback', [App\Http\Controllers\Auth\RegisterController::class, 'handleFacebookCallback'])->name('facebook.callback');

//Google login or register
Route::get('/googleRedirect', [App\Http\Controllers\Auth\RegisterController::class, 'redirectToGoogle'])->name('google.redirect');
Route::get('/googleCallback', [App\Http\Controllers\Auth\RegisterController::class, 'handleGoogleCallback'])->name('google.callback');

Route::post('/send-otp', [App\Http\Controllers\OtpController::class, 'send']);

Route::post('/forget-password/numberCheck', [App\Http\Controllers\Auth\ForgotPasswordController::class, "numberCheck"]);
Route::post('/forget-password/verifyOtp', [App\Http\Controllers\Auth\ForgotPasswordController::class, "verifyOtp"]);
Route::post('/forget-password/changePassword', [App\Http\Controllers\Auth\ForgotPasswordController::class, "changePassword"]);

Route::post('/map/getObject', [App\Http\Controllers\RentController::class, "getObject"]);
