<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\DoctorController;
use App\Http\Controllers\ReceptionistController;
use App\Http\Controllers\Superadmin\SAReceptionistController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\MedicalRecordController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\DoctorDashboardController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\WebsiteController;
use App\Http\Controllers\QRCodeController;
use App\Http\Controllers\BlogPostController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\CKEditorController;

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

Route::get('/', [WebsiteController::class, 'home'])->name('home');

Route::get('/about-us', [WebsiteController::class, 'aboutUs'])->name('aboutus');
Route::get('/testimonial', [WebsiteController::class, 'testimonial'])->name('testimonial');
Route::get('/faqs', [WebsiteController::class, 'faqs'])->name('faqs');
Route::get('/appointment', [WebsiteController::class, 'appointment'])->name('appointment');
Route::get('/serviceP', [WebsiteController::class, 'serviceP'])->name('serviceP');
Route::get('/staff', [WebsiteController::class, 'staff'])->name('staff');
Route::get('/contact', [WebsiteController::class, 'contact'])->name('contact');
Route::get('/privacy', [WebsiteController::class, 'privacy'])->name('privacy');
Route::get('/term', [WebsiteController::class, 'term'])->name('term');
Route::get('/drpnbehl', [WebsiteController::class, 'drpnbehl'])->name('drpnbehl');
Route::get('/facilities', [WebsiteController::class, 'facilities'])->name('facilities');
Route::get('/skin-diseases-treatments', [WebsiteController::class, 'skinDiseasesTreatments'])->name('skin-diseases-treatments');
Route::get('/treatments-services', [WebsiteController::class, 'treatmentsServices'])->name('treatments-services');
Route::get('/aims-and-objectives', [WebsiteController::class, 'aimsObjectives'])->name('aimsobjectives');
Route::get('/mission', [WebsiteController::class, 'mission'])->name('mission');
Route::get('/vision', [WebsiteController::class, 'vision'])->name('vision');
Route::get('/blog', [WebsiteController::class, 'blog'])->name('blog');
Route::get('/blog/{slug}', [WebsiteController::class, 'blogShow'])->name('blog.show');

Route::post('/contact-submit', [ContactController::class, 'submit'])->name('contact.submit');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'role:super_admin'])->group(function () {
    Route::get('/superadmin/dashboard', [DashboardController::class, 'superadmin'])->name('superadmin.dashboard');
    Route::resource('superadmin/receptionists', SAReceptionistController::class)
    ->names([
        'index' => 'superadmin.receptionists.index',
        'create' => 'superadmin.receptionists.create',
        'store' => 'superadmin.receptionists.store',
        'show' => 'superadmin.receptionists.show',
        'edit' => 'superadmin.receptionists.edit',
        'update' => 'superadmin.receptionists.update',
        'destroy' => 'superadmin.receptionists.destroy',
    ]);
    Route::resource('doctors', DoctorController::class);
    Route::resource('patients', PatientController::class);
    Route::resource('appointments', AppointmentController::class);
    Route::resource('medical-records', MedicalRecordController::class);
    Route::get('notifications', [NotificationController::class, 'index'])->name('notifications.index');
    Route::post('notifications/send', [NotificationController::class, 'send'])->name('notifications.send');
    Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
    Route::post('/reports/generate', [ReportController::class, 'generate'])->name('reports.generate');
    

    // QR Code Routes
    Route::get('/qrcodes', [QRCodeController::class, 'index'])->name('qrcodes.index');
    Route::post('/qrcodes/generate', [QRCodeController::class, 'generate'])->name('qrcodes.generate');
    Route::post('/qrcodes/scan/{code}', [QRCodeController::class, 'scan'])->name('qrcodes.scan');
    Route::delete('/qrcodes/{id}', [QRCodeController::class, 'destroy'])->name('qrcodes.destroy');
    Route::get('/qrcodes/{id}/scans', [QRCodeController::class, 'showScans'])->name('qrcodes.scans');
    Route::get('/qrcodes/download/{id}', [QRCodeController::class, 'download'])->name('qrcodes.download');

//     Route::get('/qrcodes', [QRCodeController::class, 'index']);
// Route::post('/generate-qr', [QRCodeController::class, 'generate']);
// Route::get('/scan/{code}', [QRCodeController::class, 'scan']);
// Route::delete('/qrcodes/{id}', [QRCodeController::class, 'destroy']);

});

Route::middleware(['auth', 'role:receptionist'])->group(function () {
    Route::get('/receptionist/dashboard', [DashboardController::class, 'receptionist'])->name('receptionist.dashboard');
    Route::resource('/addpatients', PatientController::class);
    Route::resource('/addappointments', AppointmentController::class);
    Route::resource('/addservices', ServiceController::class);
    Route::get('payments', [PaymentController::class, 'index'])->name('payments.index');
    Route::post('payments', [PaymentController::class, 'store'])->name('payments.store');
    // Route::resource('/appointments', AppointmentController::class);
    // Route::get('/appointments/time-slots', [AppointmentController::class, 'getAvailableTimeSlots'])->name('appointments.time-slots');
    // Route::get('/appointments/{appointment}/pdf', [AppointmentController::class, 'generatePDF'])->name('appointments.generatePDF');
    Route::get('/patients/{patient}/visits', [PatientController::class, 'visits'])->name('patients.visits');

    Route::resource('appointments', AppointmentController::class);
    Route::get('appointments/time-slots', [AppointmentController::class, 'getAvailableTimeSlots'])->name('appointments.time-slots');
    Route::get('appointments/time-slots/{doctor_id}', [AppointmentController::class, 'getAvailableTimeSlots'])->name('appointments.time-slotss');
    
    Route::get('appointments/{appointment}/pdf', [AppointmentController::class, 'generatePDF'])->name('appointments.generatePDF');
    Route::resource('patients', PatientController::class);
    // Route::post('/patients/store', [PatientController::class, 'store'])->name('patients.store');
    Route::get('receptionists/patientDetails', [ReceptionistController::class, 'getPaitent'])->name('receptionists.getPatient');
    Route::get('patientDetailsForPopUp', [ReceptionistController::class, 'getPatientDetailsForPopUp'])->name('get.patient.details');
    Route::get('patient/{id}', [ReceptionistController::class, 'getPatientDetails']);
    
    Route::get('bill/print/{orderID}', [ReceptionistController::class, 'printBill']);
    Route::post('payment/add', [ReceptionistController::class, 'addDeposit']);
    Route::post('vitals/save', [ReceptionistController::class, 'saveVitals']);
    Route::post('test/save', [ReceptionistController::class, 'saveTestResult']);
    Route::get('prescription/{patientID}', [ReceptionistController::class, 'getPrescription']);
    Route::post('attachment/save', [ReceptionistController::class, 'saveAttachment']);
    Route::put('appointment/update/{id}', [ReceptionistController::class, 'updateAppointment']);
    Route::post('/reception-patient-add', [ReceptionistController::class, 'receptionPatientAdd'])->name('reception.patient.add');
    Route::post('/reception-patient-edit/{id}/update', [ReceptionistController::class, 'receptionPatientEdit'])->name('reception.patient.edit');
    Route::get('/receptionists', [ReceptionistController::class, 'getPaitent'])->name('receptionists.index');
    Route::get('/receptionistss', [ReceptionistController::class, 'getBillsModal'])->name('receptionists.getBillsModal');
    Route::get('/editAppntTab', [ReceptionistController::class, 'editAppntTab'])->name('receptionists.editAppntTab');
    Route::get('/allBillsTab', [ReceptionistController::class, 'allBillsTab'])->name('receptionists.allBillsTab');
    Route::get('/paymentsTabs', [ReceptionistController::class, 'paymentsTabs'])->name('receptionists.paymentsTabs');
    Route::get('/visitsTabs', [ReceptionistController::class, 'visitsTabs'])->name('receptionists.visitsTabs');
    Route::get('/labReportsTabs', [ReceptionistController::class, 'labReportsTabs'])->name('receptionists.labReportsTabs');
    Route::get('/patientTabs', [ReceptionistController::class, 'patientTabs'])->name('receptionists.patientTabs');
    //Route::get('/editAppntTab', [ReceptionistController::class, 'editAppntTab'])->name('receptionists.editAppntTab');
    
    //Route::get('/reception/services', [ReceptionistController::class, 'addServices'])->name('reception.addServices');
    // Route::get('/services', [ServiceController::class, 'index'])->name('reception.addServices');
    // Route::post('/services', [ServiceController::class, 'store'])->name('services.store');
    // Route::put('/services/{service}', [ServiceController::class, 'update'])->name('services.update');
    // Route::delete('/services/{service}', [ServiceController::class, 'destroy'])->name('services.destroy');
    Route::post('/appointments/store', [ReceptionistController::class, 'updateAppointments'])->name('appointments.stores');
    Route::resource('services', ServiceController::class);
    Route::post('/services/add', [ServiceController::class, 'addService'])->name('services.add');
    Route::post('/appointments/add', [AppointmentController::class, 'addAppointment'])->name('appointments.add');
    Route::post('/get-appointment-services', [ServiceController::class, 'getAppointmentServices'])->name('appointment.get.services');
    Route::get('/services', [ServiceController::class, 'index'])->name('services.index');
    Route::post('/store-patient-id', [PatientController::class, 'storePatientId'])->name('store.patient.id');
    Route::post('/forget-session-data', [ReceptionistController::class, 'forgetSessionData']);
    Route::post('/generate-bill-pdf', [ReceptionistController::class, 'generateBillPdf'])->name('generateBillPdf');
    Route::post('/deposit-add', [ReceptionistController::class, 'addDeposit'])->name('deposit.add');
    Route::get('print-bill/{billingId}', [ReceptionistController::class, 'printBill'])->name('print.bill');
    Route::get('/receptionist/reports', [ReportController::class, 'receIndex'])->name('rece.reports.index');
    Route::get('/reports/payment-methods', [ReportController::class, 'paymentMethodReport'])->name('reports.payment-methods');
    // Route::get('/receptionist/reports/appointments', [ReportController::class, 'appointmentsReport'])->name('rece.reports.appointments');
    // Route::get('/receptionist/reports/billing', [ReportController::class, 'billingReport'])->name('rece.reports.billing');
    // Route::get('/receptionist/reports/lab', [ReportController::class, 'labReport'])->name('rece.reports.lab');
    // Route::get('/receptionist/reports/others', [ReportController::class, 'othersReport'])->name('rece.reports.others');

});

Route::middleware(['auth', 'role:patient'])->group(function () {
    Route::get('/patient/dashboard', [DashboardController::class, 'patient'])->name('patient.dashboard');
});

Route::middleware(['auth', 'role:doctor'])->group(function () {
    Route::get('/doctor/dashboard', [DashboardController::class, 'doctor'])->name('doctor.dashboard');
    Route::get('/d/dashboard', [DoctorDashboardController::class, 'index'])->name('doctor.index');
    Route::get('/visit-pad/{patientId}', [DoctorDashboardController::class, 'visitPad'])->name('visit.pad');
    Route::post('/save-visits', [DoctorDashboardController::class, 'saveVisits'])->name('saveVisit');
    Route::post('/save-visit/{patientId}', [DoctorDashboardController::class, 'saveVisit'])->name('save.visit');
    Route::get('/complaints-suggestions', [DoctorDashboardController::class, 'getComplaintsSuggestions'])->name('get.complaints');
    Route::get('/diagnosis-suggestions', [DoctorDashboardController::class, 'getDiagnosisSuggestions'])->name('get.diagnosis');
    Route::get('/test-suggestions', [DoctorDashboardController::class, 'getTestSuggestions'])->name('get.test');
    Route::get('/medicine-suggestions', [DoctorDashboardController::class, 'getMedicineSuggestions'])->name('get.medicine');
    // Route::get('/print-prescription/{visitId}', [DoctorDashboardController::class, 'printPrescription'])->name('print.prescription');
    Route::get('/fetch-patient-data', [DoctorDashboardController::class, 'fetchPatientData'])->name('doctor.fetchPatientData');
    Route::get('/get-doctor-details', [DoctorDashboardController::class, 'getDoctorDetails']);
    Route::get('doctor/report/{doctorId}', [ReportController::class, 'doctorReport'])->name('doctor.report');
    Route::post('/save-new-master-item', [DoctorDashboardController::class, 'saveNewMasterItem'])->name('save.new.master.item');
    Route::post('/medicines/add', [DoctorDashboardController::class, 'medicineStore'])->name('medicines.store');
});

 
Route::middleware('auth', 'role:webadmin')->group(function () {
    Route::get('/webadmin/dashboard', [DashboardController::class, 'webadmin'])->name('webadmin.dashboard');
    Route::prefix('webadmin')->name('webadmin.')->group(function () {
        Route::resource('blog', BlogPostController::class);
        Route::resource('categories', CategoryController::class);
        Route::resource('tags', TagController::class);
        Route::post('ckeditor/upload', [CKEditorController::class, 'upload'])->name('ckeditor.upload'); 
        Route::resource('sliders', SliderController::class);
    });
    
});



Route::middleware(['auth', 'role:lab'])->group(function () {
    Route::get('/lab/dashboard', [DashboardController::class, 'lab'])->name('lab.dashboard');
});
Route::middleware(['auth'])->group(function () {
    Route::get('/print-prescription/{visitId}', [DoctorDashboardController::class, 'printPrescription'])->name('print.prescription');
    Route::get('/prescription/pdf-url/{id}', [DoctorDashboardController::class, 'getPdfUrl'])->name('prescription.pdf.url');

});
require __DIR__.'/auth.php';
