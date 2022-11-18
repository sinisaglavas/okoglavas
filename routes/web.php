<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/',[App\Http\Controllers\ClientController::class,'index'])->name('welcome');

Auth::routes();

//home
Route::get('/home', [App\Http\Controllers\HomeController::class,'index'])->name('home');
Route::get('/home-glasses', [App\Http\Controllers\HomeController::class, 'glassesClients'])->name('homeGlasses');
Route::get('/home-contact-lenses', [App\Http\Controllers\HomeController::class, 'contactLensesClients'])->
name('homeContactLenses');
Route::get('/home/show-client-form',[App\Http\Controllers\HomeController::class,'showClientForm'])->
name('home.showClientForm');
Route::get('/home/show-contact-lenses-client-form', [App\Http\Controllers\HomeController::class, 'showContactLensesForm'])->
name('home.showContactLensesForm');
Route::get('/home/show-examination-form/{id}',[App\Http\Controllers\HomeController::class,'showExaminationForm'])->
name('home.showExaminationForm');
Route::get('/home/show-contact-lenses-examination-form/{id}',[App\Http\Controllers\HomeController::class,'showContactLensesExaminationForm'])->
name('home.showContactLensesExaminationForm');
Route::get('/home/single-client/{id}',[App\Http\Controllers\HomeController::class,'showSingleClient'])->
name('home.singleClient');
Route::get('/home/single-contact-lenses-client/{id}',[App\Http\Controllers\HomeController::class,'showSingleContactLensesClient'])->
name('home.singleContactLensesClient');

//home.debtors
Route::get('/home/debtors', [App\Http\Controllers\DebtorController::class,'index'])->name('home.allDebtors');
Route::get('/home/show-single-debtor/{id}', [App\Http\Controllers\DebtorController::class,'showSingleDebtor'])->
name('home.showSingleDebtor');
Route::get('/all-debtors-contact-lenses', [App\Http\Controllers\DebtorsContactLensesController::class,'index'])->
name('allDebtorsContactLenses');



//non home
Route::get('/show-debtor-form',[App\Http\Controllers\DebtorController::class,'showDebtorForm'])->
name('showDebtorForm');
Route::get('/show-debtor-contact-lenses-form',[App\Http\Controllers\DebtorsContactLensesController::class,'showDebtorContactLensesForm'])->
name('showDebtorContactLensesForm');
Route::get('/show-all-debits',[App\Http\Controllers\PaymentController::class,'showAllDebits'])->
name('showAllDebits');
Route::get('/show-single-debtor-contact-lenses/{id}', [App\Http\Controllers\DebtorsContactLensesController::class,'showSingleDebtorContactLenses'])->
name('showSingleDebtorContactLenses');
Route::get('suitable-contact-lenses/{id}/{client_id}',[App\Http\Controllers\ContactLensesController::class,'suitableContactLenses'])->
name('suitableContactLenses');


//home
Route::post('/home/save-client-form',[App\Http\Controllers\HomeController::class,'saveClientForm'])->
name('home.saveClient');
Route::post('/home/save-contact-lenses-client-form', [App\Http\Controllers\HomeController::class, 'saveContactLensesClientForm'])->
name('home.saveContactLensesClientForm');
Route::post('/home/save-client-debit-form',[App\Http\Controllers\HomeController::class,'saveClientDebitForm'])->
name('home.saveClientDebit');
Route::post('/home/save-distance-form/{id}',[App\Http\Controllers\HomeController::class,'saveDistanceForm'])->
name('home.saveDistance');
Route::post('/home/save-proximity-form/{id}',[App\Http\Controllers\HomeController::class,'saveProximityForm'])->
name('home.saveProximity');



//non home
Route::post('/save-debtor-form',[App\Http\Controllers\DebtorController::class,'saveDebtorForm'])->
name('saveDebtorForm');
Route::post('/save-add-debtor-form/{id}',[App\Http\Controllers\DebtorController::class,'saveAddDebtorForm'])->
name('saveAddDebtorForm');
Route::post('/search-form',[App\Http\Controllers\ClientController::class,'searchClient'])->name('searchClient');

Route::post('/search-contact-lenses-form',[App\Http\Controllers\ContactLensesClientController::class,'searchContactLensesClients'])->
name('searchContactLensesClients');

Route::post('/search-contact-lenses-type/{id}',[App\Http\Controllers\ContactLensesController::class,'searchContactLensesType'])->
name('searchContactLensesType');

Route::post('/save-contact-lenses-form/{id}',[App\Http\Controllers\ContactLensesClientController::class,'saveContactLensesForm'])->
name('saveContactLensesForm');

Route::post('/save-debtor-contact-lenses-form',[App\Http\Controllers\DebtorsContactLensesController::class,'saveDebtorContactLensesForm'])->
name('saveDebtorContactLensesForm');

Route::post('/save-payment-contact-lenses-form/{id}',[App\Http\Controllers\PaymentContactLenseController::class,'savePaymentContactLensesForm'])->
name('savePaymentContactLensesForm');





//home.debtors
Route::post('/home/save-payment-form/{id}',[App\Http\Controllers\PaymentController::class,'savePaymentForm'])->
name('home.savePaymentForm');

