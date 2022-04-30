<?php

use Inertia\Inertia;
use App\Models\PaymentPlan;
use Laravel\Fortify\Fortify;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BankController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\PaymentPlanController;
use App\Http\Controllers\ApplicationStageController;
use App\Http\Controllers\LeasingApplicationController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Auth/Login');
})->name('login');


Route::middleware(['auth'])->group(function () {

    Route::group(['middleware' => 'CheckProfileUpdate'], function () {
        Route::get('/dashboard', [HomeController::class, 'index']);
        Route::get('/dashboard/stats', [HomeController::class, 'stats']);
        Route::get('/my-application', [LeasingApplicationController::class, 'index']);
        // Route::get('/create-application',[LeasingApplicationController::class, 'create']);
        Route::get('/create-application-index', [LeasingApplicationController::class, 'createApplicationIndex']);
        Route::post('/updateApplication', [LeasingApplicationController::class, 'editApplication']);
        Route::post('/create-application', [LeasingApplicationController::class, 'store']);
        Route::post('/delete-application', [LeasingApplicationController::class, 'delete']);
        Route::post('/activate-deactivate', [LeasingApplicationController::class, 'activateDeactivate']);
        Route::get('/client/{client}', [LeasingApplicationController::class, 'getClient']);

        Route::post('/updateGuarantor', [LeasingApplicationController::class, 'updateGuarantor']);
        Route::get('/pay_plan', [PaymentController::class, 'index']);
        Route::post('/savePercenetage', [PaymentController::class, 'store']);
        Route::post('/savePaid', [PaymentController::class, 'savePaid']);
        Route::post('/saveEdit', [PaymentController::class, 'saveEdit']);
        Route::post('/deleteSetting', [PaymentController::class, 'del']);
        Route::get('/makePayment', [PaymentController::class, 'pay']);
        Route::post('/payment/transaction/create', [PaymentController::class, 'payCreate']);
        Route::get('/payment/transaction/response', [PaymentController::class, 'transaction_response']);
        Route::post('/saveSupplier', [SupplierController::class, 'save']);
        Route::post('/updateSupplier', [SupplierController::class, 'update']);
        Route::post('/uploadCertificate', [SupplierController::class, 'UploadCertificate']);
        Route::post('/DownloadCertificate', [SupplierController::class, 'DownloadCertificate']);
        Route::get('/paySetting', [SupplierController::class, 'paySettings']);
        Route::get('/cashpayment', [SupplierController::class, 'cash']);
        Route::get('/history', [SupplierController::class, 'history']);
        Route::get('/checkStatus', [SupplierController::class, 'checkStatus']);
        Route::get('/supplier', [SupplierController::class, 'index']);
        Route::post('/getNextPay', [SupplierController::class, 'getNextPay']);
        Route::post('/attachPlan', [SupplierController::class, 'attachPlan']);

        // payment Plan routes
        Route::get('/payment-plan', [PaymentPlanController::class, 'index']);
        Route::post('/savePlan', [PaymentPlanController::class, 'create']);
        Route::post('/editSavedPlan', [PaymentPlanController::class, 'edit']);
        Route::post('/deletePaymentPlan', [PaymentPlanController::class, 'destroy']);

        //application stages
        Route::post('/get-application', [ApplicationStageController::class, 'getApplication']);
        Route::get('/get-payment-plan', [ApplicationStageController::class, 'getPaymentPlan']);
    });
    Route::post('/photoUpdate', [ProfileController::class, 'photoUpdate']);
    Route::post('/application/resolve_account', [BankController::class, 'resolve_account']);
    Route::post('/application/save_account', [BankController::class, 'save_account']);
    Route::post('/application/resolve_bvn', [BankController::class, 'resolve_bvn']);
    Route::post('/application/save_bvn', [BankController::class, 'save_bvn']);
    Route::post('/application/save_nin', [BankController::class, 'save_nin']);
    Route::get('/application/AllBanks', [BankController::class, 'banks']);
    Route::post('/updatePassword', [ProfileController::class, 'updatePassword']);
    Route::get('/2fa',  function () {
        return view('auth.two-factor-challenge');
    });
    Route::get('/2fas',  function () {
        return Inertia::render('Auth/TwoFactor');
    });

    Route::post('/profileEdit', [ProfileController::class, 'edit']);
    Route::group(['prefix' => '/profile'], function () {
        Route::get('/', [ProfileController::class, 'index']);
        Route::get('/{id}', [ProfileController::class, 'index']);
    });
});
