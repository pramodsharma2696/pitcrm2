<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DummyController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

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


// USER ROUTES 'redirect.back'
Route::middleware(['otp.verified'])->group(function () {
    Route::get('/user/dashboard', [UserController::class, 'index'])->name('dashboard');
    Route::get('/user/upsi/create', [UserController::class, 'Create'])->name('upsi.create');
        // Inner Route
        Route::get('/user/upsi/add/{id}', [UserController::class, 'Add'])->name('upsi.add');
    Route::post('/user/upsi/store', [UserController::class, 'Store'])->name('upsi.store');
    Route::post('/user/addMoreRecords/store', [UserController::class, 'addMoreRecords'])->name('upsi.addMoreRecords');
    Route::get('/user/upsi/list/{id}', [UserController::class, 'OPenUpsiList'])->name('upsi.open-upsi-list');
    Route::get('/user/upsi/read/{id}', [UserController::class, 'UpsiRead'])->name('upsi.read');
    Route::get('/user/upsi/edit/{id}', [UserController::class, 'UpsiEdit'])->name('upsi.edit');
    Route::get('/user/upsi/delete/{id}', [UserController::class, 'UpsiDelete'])->name('upsi.delete');
    Route::post('/user/upsi/update', [UserController::class, 'Update'])->name('upsi.update');
    Route::post('upsi/documents', [DocumentController::class, 'UpsiDocumentstore'])->name('upsi.documents.store');
    Route::get('upsi/documents/{id}/download', [DocumentController::class, 'UpsiDocumentdownload'])->name('upsi.documents.download');
    Route::get('upsi/documents/add', [DocumentController::class, 'addUpsiDocuments'])->name('upsi.documents.add');
    Route::get('upsi/documents/{id}/delete', [DocumentController::class, 'deleteUpsiDocument'])->name('upsi.documents.delete');
    Route::get('upsi/get/documents', [DocumentController::class, 'showUpsiDocuments'])->name('upsi.documents.show');
    Route::get('/upsi/{id}/download', [UserController::class, 'download'])->name('Attachment.documents.download');


});


// ADMIN ROUTES
Route::middleware(['auth', 'verified','otp.verified'])->group(function () {
    // Dashboard
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admindashboard');
    // UPSI
    Route::get('/admin/upsi/read/{id}', [AdminController::class, 'UpsiRead'])->name('admin.upsi.read');
    Route::get('/admin/upsi/edit/{id}', [AdminController::class, 'UpsiEdit'])->name('admin.upsi.edit');
    Route::get('/admin/upsi/delete/{id}', [AdminController::class, 'UpsiDelete'])->name('admin.upsi.delete');

    Route::get('/admin/upsi/list/', [AdminController::class, 'UpsiList'])->name('upsi.list');
    Route::get('/admin/upsi/approve/{id}', [AdminController::class, 'UpsiApprove'])->name('upsi.approve');
    
    //Admin UPSI Edit
    Route::get('/admin/upsi/edit/list/{id}', [AdminController::class, 'AdminUpsiEdit'])->name('admin.upsi.edit.list');
    Route::post('/admin/Upsi/update/list/{id}', [AdminController::class, 'AdminUpsiupdate'])->name('admin.update-upsi-list');
    Route::post('/admin/update/field/values/', [AdminController::class, 'updateFieldValues'])->name('admin.field-values');

    // Master Data
    Route::get('/admin/master/data', [AdminController::class, 'masterData'])->name('master-data.add');
    Route::post('/admin/company/data/store', [AdminController::class, 'saveCompanyData'])->name('master-data.store');
    Route::get('/admin/master/data/records', [AdminController::class, 'showAllCompanyData'])->name('master-data.records');
    Route::get('/admin/edit/master/data/{id}', [AdminController::class, 'editCompanyData'])->name('master-data.edit');
    Route::post('/admin/company/data/update/{id}', [AdminController::class, 'updateCompanyData'])->name('master-data.update');
    Route::get('/admin/show/master/data/{id}', [AdminController::class, 'showSingleCompanyData'])->name('master-data.show');
    Route::get('/get/company/documents', [DocumentController::class, 'showCompanyDocuments'])->name('company.documents.show');
    Route::post('/documents', [DocumentController::class, 'companyDocumentstore'])->name('company.documents.store');
    Route::get('/documents/{id}/download', [DocumentController::class, 'companydownload'])->name('company.documents.download');
    Route::get('/documents/add', [DocumentController::class, 'addCompanyDocuments'])->name('company.documents.add');
    Route::get('/documents/{id}/delete', [DocumentController::class, 'deleteCompanyDocument'])->name('company.documents.delete');



    // Connected Person
    Route::get('/admin/connected/person/record', [AdminController::class, 'showAllConnectedPerson'])->name('connected-person.records');
    Route::get('/admin/connected/person/add', [AdminController::class, 'showConnectedPersonPage'])->name('connected-person.add');
    Route::post('/admin/connected/person/store', [AdminController::class, 'saveConnectedPersonDetails'])->name('connected-person.store');
    Route::get('/admin/edit/connected/person/{id}', [AdminController::class, 'editConnectedPerson'])->name('connected-person.edit');
    Route::post('/admin/connected/person/update/{id}', [AdminController::class, 'updateConnectedPersonDetails'])->name('connected-person.update');
    Route::get('/admin/show/connected/data/{id}', [AdminController::class, 'showSingleConnectedPerson'])->name('connected-person.show');
    Route::get('/admin/revoke/connected/person/{id}', [AdminController::class, 'revokeInsider'])->name('connected-person.revokeInsider');
    Route::get('/admin/make/connected/person/{id}', [AdminController::class, 'makeInsider'])->name('connected-person.makeInsider');
    Route::get('/admin/delete/connected/person/{id}', [AdminController::class, 'deleteConnectedPerson'])->name('connected-person.delete');
    Route::post('/get-pan-details', [AdminController::class, 'getPanDetails'])->name('getPanDetails');
    Route::get('connected/get/documents', [DocumentController::class, 'showConnectedPersonDocuments'])->name('connected-person.documents.show');
    Route::post('connected/documents', [DocumentController::class, 'ConnectedPersonDocumentstore'])->name('connected-person.documents.store');
    Route::get('connected/documents/{id}/download', [DocumentController::class, 'ConnectedPersondownload'])->name('connected-person.documents.download');
    Route::get('connected/documents/add', [DocumentController::class, 'addConnectedPersonDocuments'])->name('connected-person.documents.add');
    Route::get('connected/documents/{id}/delete', [DocumentController::class, 'deleteConnectedPersonDocument'])->name('connected-person.documents.delete');
    // Immediate Relative
    Route::get('/admin/immediate/relative', [AdminController::class, 'showImmediateRelativePage'])->name('immediate-relative.add');
    Route::post('/admin/immediate/relative/store', [AdminController::class, 'saveImmediateRelativeDetails'])->name('immediate-relative.store');
    Route::get('/admin/immediate/relative/record', [AdminController::class, 'showAllImmediateRelative'])->name('immediate-relative.records');
    Route::get('/admin/edit/immediate/relative/{id}', [AdminController::class, 'editImmediateRelative'])->name('immediate-relative.edit');
    Route::post('/admin/immediate/relative/update/{id}', [AdminController::class, 'updateImmediateRelativeDetails'])->name('immediate-relative.update');
    Route::get('/admin/show/immediate/relative/{id}', [AdminController::class, 'showSingleImmediateRelative'])->name('immediate-relative.show');
    Route::get('/admin/delete/immediate/relative/{id}', [AdminController::class, 'deleteImmediateRelative'])->name('immediate-relative.delete');
    Route::get('immediate/relative/get/documents', [DocumentController::class, 'showimmediateRelativeDocuments'])->name('immediate-relative.documents.show');
    Route::post('immediate/relative/documents', [DocumentController::class, 'immediateRelativeDocumentstore'])->name('immediate-relative.documents.store');
    Route::get('immediate/relative/documents/{id}/download', [DocumentController::class, 'immediateRelativeDocumentdownload'])->name('immediate-relative.documents.download');
    Route::get('immediate/relative/documents/add', [DocumentController::class, 'addimmediateRelativeDocuments'])->name('immediate-relative.documents.add');
    Route::get('immediate/relative/documents/{id}/delete', [DocumentController::class, 'deleteimmediateRelativeDocument'])->name('immediate-relative.documents.delete');

    // Financial Relative
    Route::get('/admin/financial/relative', [AdminController::class, 'showFinancialRelativePage'])->name('financial-relative.add');
    Route::post('/admin/financial/relative/store', [AdminController::class, 'saveFinancialRelativeDetails'])->name('financial-relative.store');
    Route::get('/admin/financial/relative/record', [AdminController::class, 'showAllFinancialRelative'])->name('financial-relative.records');
    Route::get('/admin/edit/financial/relative/{id}', [AdminController::class, 'editFinancialRelative'])->name('financial-relative.edit');
    Route::post('/admin/financial/relative/update/{id}', [AdminController::class, 'updateFinancialRelativeDetails'])->name('financial-relative.update');
    Route::get('/admin/show/financial/relative/{id}', [AdminController::class, 'showSingleFinancialRelative'])->name('financial-relative.show');
    Route::get('/admin/delete/financial/relative/{id}', [AdminController::class, 'deleteFinancialRelative'])->name('financial-relative.delete');
    Route::get('financial/relative/get/documents', [DocumentController::class, 'showFinancialRelativeDocuments'])->name('financial-relative.documents.show');
    Route::post('financial/relative/documents', [DocumentController::class, 'financialRelativeDocumentstore'])->name('financial-relative.documents.store');
    Route::get('financial/relative/documents/{id}/download', [DocumentController::class, 'financialRelativeDocumentdownload'])->name('financial-relative.documents.download');
    Route::get('financial/relative/documents/add', [DocumentController::class, 'addFinancialRelativeDocuments'])->name('financial-relative.documents.add');
    Route::get('financial/relative/documents/{id}/delete', [DocumentController::class, 'deletefinancialRelativeDocument'])->name('financial-relative.documents.delete');
    // Insider
    Route::get('/admin/insider/details/add', [AdminController::class, 'showInsiderPage'])->name('insider-detail.add');
    Route::post('/admin/insider/details/store', [AdminController::class, 'saveInsiderDetails'])->name('insider-detail.store');
    Route::get('/admin/insider/details/record', [AdminController::class, 'showAllInsiderDetails'])->name('insider-detail.records');
    Route::get('/admin/edit/insider/details/{id}', [AdminController::class, 'editInsiderDetails'])->name('insider-detail.edit');
    Route::post('/admin/insider/details/update/{id}', [AdminController::class, 'updateInsiderDetails'])->name('insider-detail.update');
    Route::get('/admin/show/insider/details/{id}', [AdminController::class, 'showSingleInsiderDetails'])->name('insider-detail.show');
    Route::get('/admin/delete/insider/details/{id}', [AdminController::class, 'deleteInsiderDetails'])->name('insider-detail.delete');
    Route::get('insider/get/documents', [DocumentController::class, 'showInsiderDocuments'])->name('insider-documents.show');
    Route::post('insider/documents', [DocumentController::class, 'InsiderDocumentstore'])->name('insider.documents.store');
    Route::get('insider/documents/{id}/download', [DocumentController::class, 'InsiderDocumentdownload'])->name('insider.documents.download');
    Route::get('insider/documents/add', [DocumentController::class, 'addInsiderDocuments'])->name('insider.documents.add');
    Route::get('insider/documents/{id}/delete', [DocumentController::class, 'deleteInsiderDocument'])->name('insider.documents.delete');


    // Breach UPSi
    Route::get('/admin/breach/upsi/add', [AdminController::class, 'showBreachUpsiPage'])->name('breach-upsi.add');
    Route::post('/admin/breach/upsi/store', [AdminController::class, 'saveBreachUpsiDetails'])->name('breach-upsi.store');
    Route::get('/admin/breach/upsi/record', [AdminController::class, 'showAllBreachUpsiDetails'])->name('breach-upsi.records');
    Route::get('/admin/edit/breach/upsi/{id}', [AdminController::class, 'editBreachUpsiDetails'])->name('breach-upsi.edit');
    Route::post('/admin/breach/upsi/update/{id}', [AdminController::class, 'updateBreachUpsiDetails'])->name('breach-upsi.update');
    Route::get('/admin/show/breach/upsi/{id}', [AdminController::class, 'showSingleBreachUpsiDetails'])->name('breach-upsi.show');
    Route::get('/admin/delete/breach/upsi/{id}', [AdminController::class, 'deleteBreachUpsiDetails'])->name('breach-upsi.delete');
    Route::get('/get/documents', [DocumentController::class, 'showBreachUpsiDocuments'])->name('breach-upsi.documents.show');
    Route::post('breach/documents', [DocumentController::class, 'BreachUpsiDocumentstore'])->name('breach-upsi.documents.store');
    Route::get('breach/documents/{id}/download', [DocumentController::class, 'BreachUpsiDocumentdownload'])->name('breach-upsi.documents.download');
    Route::get('breach/documents/add', [DocumentController::class, 'addBreachUpsiDocuments'])->name('breach-upsi.documents.add');
    Route::get('breach/documents/{id}/delete', [DocumentController::class, 'deleteBreachUpsiDocument'])->name('breach-upsi.documents.delete');

    // System Handling Users
    Route::get('/admin/new/user/page', [AdminController::class, 'addNewUserPage'])->name('system-user.page');
    Route::post('/admin/new/user/store', [AdminController::class, 'systemCreatedUser'])->name('system-user.store');
    Route::get('/admin/edit/user/{id}', [AdminController::class, 'editUser'])->name('user.edit');
    Route::post('/admin/update/user/{id}', [AdminController::class, 'updateUser'])->name('user.update');
    Route::get('/admin/delete/user/{id}', [AdminController::class, 'deleteUser'])->name('user.delete');
    Route::get('/admin/show/user/{id}', [AdminController::class, 'showUser'])->name('user.show');

    // Reports Downloading
    Route::get('/admin/reports/page/', [ReportController::class, 'index'])->name('reports.page');
    Route::get('/admin/connected/person/reports/download/', [ReportController::class, 'downloadConnectedPersonReport'])->name('reports.connected-person.excel');
    Route::get('/admin/insider/reports/download/', [ReportController::class, 'downloadInsiderReport'])->name('reports.insider.excel');
    Route::get('/admin/connected-persons/report', [ReportController::class, 'generateConnectedPersonPdf'])->name('reports.connected-person.pdf');
    Route::get('/admin/insider/pdf/report', [ReportController::class, 'downloadInsiderPdf'])->name('reports.insider.pdf');
    Route::get('/admin/download/UPSI/report/', [ReportController::class, 'downloadUPSIReport'])->name('reports.UPSI.excel');
    Route::get('/admin/download/UPSI/pdf/', [ReportController::class, 'downloadUPSIPdf'])->name('reports.UPSI.pdf');




});

Route::get('/otp/verify', [AuthenticatedSessionController::class, 'showOtpVerificationForm'])->name('otp.verify');
Route::post('/otp/verify', [AuthenticatedSessionController::class, 'verifyOtp']);


// PROFILE ROUTES

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
