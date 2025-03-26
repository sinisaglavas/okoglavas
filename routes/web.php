<?php

use Illuminate\Support\Facades\Route;
use App\Http\Resources\UserResource;
use App\Models\User;
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
Route::get('/all-stock', [App\Http\Controllers\HomeController::class, 'showStock'])->name('allStock');
Route::get('/home/show-new-type-contact-lens-form', [App\Http\Controllers\HomeController::class, 'showNewTypeContactLensForm']);

Route::middleware(['auth'])->group(function () {
    Route::get('/home/stock-contact-lenses', [App\Http\Controllers\StockController::class, 'stockContactLenses'])->
    name('home.stockContactLenses'); // ovo je ruta za prikaz svih kontaktnih sočiva u stanju na lageru
    Route::get('/home/stock-glasses', [App\Http\Controllers\StockController::class, 'stockGlasses'])->
    name('home.stockGlasses'); // ovo je ruta za prikaz svih naočara u stanju na lageru
    Route::get('/home/stock-sunglasses', [App\Http\Controllers\StockController::class, 'stockSunglasses'])->
    name('home.stockSunglasses'); // ovo je ruta za prikaz svih sunčanih naočara u stanju na lageru
    Route::get('/home/stock-dioptric-lenses', [App\Http\Controllers\StockController::class, 'stockDioptricLenses'])->
    name('home.stockDioptricLenses'); // ovo je ruta za prikaz svih dioptrijskih sociva u stanju na lageru
});

//home.debtors
Route::middleware(['auth'])->group(function () {
    Route::get('/home/debtors', [App\Http\Controllers\DebtorController::class,'index'])->name('home.allDebtors');
    Route::get('/home/show-single-debtor/{id}', [App\Http\Controllers\DebtorController::class,'showSingleDebtor'])->
    name('home.showSingleDebtor');
    Route::get('/all-debtors-contact-lenses', [App\Http\Controllers\DebtorsContactLensesController::class,'index'])->
    name('allDebtorsContactLenses');
    Route::get('/unpaid-debt', [App\Http\Controllers\DebtorController::class, 'unpaidDebt'])->name('unpaidDebt');
    Route::get('/unpaid-debt-contact-lenses', [App\Http\Controllers\DebtorsContactLensesController::class, 'unpaidDebtCL'])->name('unpaidDebtCL');
});

//non home
Route::middleware(['auth'])->group(function () {
    Route::get('/show-debtor-form',[App\Http\Controllers\DebtorController::class,'showDebtorForm'])->
    name('showDebtorForm');
    Route::get('/show-debtor-contact-lenses-form',[App\Http\Controllers\DebtorsContactLensesController::class,'showDebtorContactLensesForm'])->
    name('showDebtorContactLensesForm');
    Route::get('/show-all-debits',[App\Http\Controllers\PaymentController::class,'showAllDebits'])->
    name('showAllDebits');
    Route::get('/show-single-debtor-contact-lenses/{id}', [App\Http\Controllers\DebtorsContactLensesController::class,'showSingleDebtorContactLenses'])->
    name('showSingleDebtorContactLenses');
    Route::get('/suitable-contact-lenses/{id}/{client_id}',[App\Http\Controllers\ContactLensesController::class,'suitableContactLenses'])->
    name('suitableContactLenses');
    Route::get('/show-stock-form',[App\Http\Controllers\StockController::class,'showStockForm'])->
    name('showStockForm');
    Route::get('/turnover-by-days',[App\Http\Controllers\Turnover_by_dayController::class, 'index'])->name('turnoverByDays');
    Route::get('/show-daily-turnover',[App\Http\Controllers\DailyTurnoverController::class, 'index'])->name('showDailyTurnover');
    Route::get('/daily-turnover', [App\Http\Controllers\DailyTurnoverController::class, 'showDailyTurnover'])->name('dailyTurnover'); // ruta za JS
    Route::get('/total-per-day', [App\Http\Controllers\Turnover_by_dayController::class, 'totalPerDay'])->name('totalPerDay'); // ruta za JS
    Route::get('/requested/{turnover_by_day}/day', [App\Http\Controllers\Turnover_by_dayController::class, 'displayTurnover'])->name('displayTurnover');
    Route::get('/descending-article/{search_date}', [App\Http\Controllers\DailyTurnoverController::class, 'descendingArticle'])->name('descendingArticle');

    Route::get('/update/{id}/{stock_id}/{search_date}/{sum}/before-delete', [App\Http\Controllers\DailyTurnoverController::class, 'updateBeforeDelete'])->name('updateBeforeDelete');
    Route::get('/show-debt-company-form', [App\Http\Controllers\CompanyDebtorController::class, 'showDebtCompanyForm'])->name('showDebtCompanyForm');
    Route::get('/view-all-companies', [App\Http\Controllers\DebtCompanyController::class, 'viewAllCompany'])->name('viewAllCompany');
    Route::get('/view-clients-organisations', [App\Http\Controllers\CompanyDebtorController::class, 'viewClientsOrganisations'])->name('viewClientsOrganisations');
    Route::get('/client-organisation/{id}/delete', [App\Http\Controllers\CompanyDebtorController::class, 'deleteClientOrganisation'])->name('deleteClientOrganisation');
    Route::get('/clients-show/{id}', [App\Http\Controllers\ClientController::class, 'clientsShow'])->name('clientsShow');
    Route::get('/show-client-data/{id}', [App\Http\Controllers\ClientController::class, 'showClientData'])->name('showClientData');
    Route::get('/show-contact-lenses-client-data/{id}', [App\Http\Controllers\ContactLensesClientController::class, 'showContactLensesClientData'])->name('showContactLensesClientData');
    Route::get('/client-purchases/{client_id}', [App\Http\Controllers\DailyTurnoverController::class, 'getClientPurchases'])->name('getClientPurchases');
});

//update
Route::middleware(['auth'])->group(function () {
    Route::put('/client/{id}/edit', [App\Http\Controllers\ClientController::class, 'update'])->name('update');
    Route::put('/contact-lenses-client/{id}/edit', [App\Http\Controllers\ContactLensesClientController::class, 'update'])->name('updateCL');
    Route::put('/client-examination/{id}/edit', [App\Http\Controllers\ClientController::class, 'updateExamination'])->name('updateExamination');
    Route::put('/stock/{id}/edit', [App\Http\Controllers\StockController::class, 'updateStock'])->name('updateStock');
    Route::put('/user/{id}/edit', [App\Http\Controllers\UserController::class, 'updateUser'])->name('updateUser');
});

Route::put('/home/edit-distance-form/{id}',[App\Http\Controllers\HomeController::class,'updateDistance'])->name('updateDistance');
Route::put('/home/edit-proximity-form/{id}',[App\Http\Controllers\HomeController::class,'updateProximity'])->name('updateProximity');
Route::put('/home/edit-contact-lenses-exam-form/{id}',[App\Http\Controllers\HomeController::class,'updateContactLensesExam'])->name('updateContactLensesExam');

//edit
Route::middleware(['auth'])->group(function () {
    Route::get('/client/{id}/edit', [App\Http\Controllers\ClientController::class, 'edit'])->name('edit');
    Route::get('/contact-lenses-client/{id}/edit', [App\Http\Controllers\ContactLensesClientController::class, 'edit'])->name('editCL');
    Route::get('/distance-form/{distance_id}/edit', [App\Http\Controllers\ClientController::class, 'editDistanceForm']);
    Route::get('/proximity-form/{proximity_id}/edit', [App\Http\Controllers\ClientController::class, 'editProximityForm']);
    Route::get('/contact-lens-form/{contact_lenses_exam_id}/edit', [App\Http\Controllers\ClientController::class, 'editContactLensesExam']);

    Route::get('/user-edit', [App\Http\Controllers\UserController::class, 'editUser'])->name('editUser');
    Route::get('/stock/{id}/edit', [App\Http\Controllers\StockController::class, 'editStock'])->name('editStock');

    Route::get('/generate-prescription/{id}/{from_table}', [App\Http\Controllers\PrescriptionController::class, 'generatePDF'])->
    name('generatePDF');
});






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

Route::post('/home/save-contact-lens-type-form', [App\Http\Controllers\HomeController::class, 'saveContactLensTypeForm'])->
name('home.saveContactLensTypeForm');
Route::post('/home/send-sms/{id}', [App\Http\Controllers\HomeController::class, 'sendSms'])->name('home.sendSms');

//non home
Route::middleware(['auth'])->group(function () {
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

    Route::post('/save-stock',[App\Http\Controllers\StockController::class,'saveStock'])->name('saveStock');

    Route::match(['get', 'post'], '/search-stock',[App\Http\Controllers\StockController::class,'searchStock'])->name('searchStock');//get za paginaciju
    Route::match(['get', 'post'],'/search-stock-barcode',[App\Http\Controllers\StockController::class,'searchStockBarcode'])->name('searchStockBarcode');

    Route::get('/requested-day', [App\Http\Controllers\DailyTurnoverController::class, 'requestedDay'])->name('requestedDay');
    Route::post('/daily-turnover', [App\Http\Controllers\DailyTurnoverController::class, 'saveDailyTurnover'])->name('dailyTurnover');

    Route::post('/save-new-client-company-form',[App\Http\Controllers\CompanyDebtorController::class,'saveNewClientCompany'])->name('saveNewClientCompany');

    Route::post('/save-new-company',[App\Http\Controllers\DebtCompanyController::class,'saveNewCompany'])->name('saveNewCompany');

    Route::post('/search-debt-form',[App\Http\Controllers\DebtorController::class,'searchDebtClient'])->name('searchDebtClient');

//home.debtors
    Route::post('/home/save-payment-form/{id}',[App\Http\Controllers\PaymentController::class,'savePaymentForm'])->
    name('home.savePaymentForm');

    Route::get('/view-monthly-turnover/{id}', [App\Http\Controllers\DailyTurnoverController::class, 'viewMonthlyTurnover']);

    Route::post('/home/date-range', [App\Http\Controllers\DailyTurnoverController::class, 'dateRange'])->name('dateRange');

    Route::post('/check-article-data', [App\Http\Controllers\StockController::class, 'checkArticleData']);
});



