<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FileController;
use App\Http\Controllers\CarDetailController;


use App\Http\Controllers\AdminController;

use App\Http\Controllers\AdmincarController;
use App\Http\Controllers\HomesController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\AdminuserController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\ProfileController;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\CancelledBookingByIdUser;
use App\Http\Controllers\CompletedBookingByIdUser;
use App\Http\Controllers\DriversController;
use App\Http\Controllers\HomepageController;
use App\Http\Controllers\InvoiceConfirmedBookingController;
use App\Http\Controllers\SelfdriveController;
use App\Http\Controllers\ReportsController;
use App\Http\Livewire\IsAdmin\CarReportsComponent;
use App\Http\Livewire\IsAdmin\FeedbackReportsComponent;
use App\Http\Livewire\IsAdmin\ReportsController as IsAdminReportsController;
use App\Http\Controllers\UserActivityController;
use App\Http\Livewire\IsAdmin\BanuserComponent;
use App\Http\Livewire\IsAdmin\UserLogs;
use App\Http\Controllers\RemarksController;


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

Route::get('/', [HomepageController::class, 'index']);

// Route::get('index', function () {
//     return view('layouts.homepage.index');
// });

// Route::get('about-us', function () {
//     return view('about-us');
// });
Route::get('/about-us', [HomeController::class, 'about_us']);

Route::get('contact', function () {
    return view('contact');
});

Route::get('adminlogin', function () {
    return view('admin/index');
});


Route::resource('car_details', CarDetailController::class);




// Route::get('upload-car', function () {
//     return view('uploadcar');
// });

// Route::get('car-listing', function () {
//     return view('car-listing');
// });


// Route::post('post-to-server',[FileController::class, 'index']);



Auth::routes(['verify' => true]);



Route::middleware(['is-ban', 'auth', 'verified'])->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('user.dashboard');
    // route::get('adminuser', BanuserComponent::class);
    route::get('adminuser', [AdminuserController::class, 'adminuser']);
    // Route::post('userBan', [AdminuserController::class, 'ban'])->name('users.ban');
    Route::post('userBanWithreason', [AdminuserController::class, 'userBanWithreason'])->name('userBanWithreason');
    Route::post('user/revokeuser', [AdminuserController::class, 'revoke'])->name('user.revokeuser');
});

Route::get('upload-car', [CarDetailController::class, 'create']);
Route::get('car-listing', [CarDetailController::class, 'index']);
Route::get('cardetail/{car_details}', [CarDetailController::class, 'show']);
Route::get('myposts/{car_details}', [CarDetailController::class, 'userpost']);
Route::get('editcar/{CarDetail}', [CarDetailController::class, 'edit']);
Route::get('deletecar/{car_details}', [CarDetailController::class, 'destroy']);
Route::get('updatecar/{car_details}', [CarDetailController::class, 'update']);
Route::get('withdriver', [CarDetailController::class, 'withdriver']);
Route::get('withoutdriver', [CarDetailController::class, 'withoutdriver']);
Route::get('allcars', [CarDetailController::class, 'allcars']);

Route::get('reg-users', [RegisterController::class, 'usersdata']);
Route::get('getregions/registration', [RegisterController::class, 'getRegions']);
Route::get('getprovince/registration', [RegisterController::class, 'getProvince']);
Route::get('getcities/registration', [RegisterController::class, 'getCities']);
Route::get('getbarangays/registration', [RegisterController::class, 'getBarangays']);

// Route::post('store-car-detail',[CarDetailController::class,'store']);
//

route::get('administrator', [AdminController::class, 'administrator']);

route::get('addcar', [AdminController::class, 'addcar']);
Route::get('admin_dashboard', [AdminController::class, 'dashboard']);
Route::get('expiredfunction', [BookingController::class, 'expiredFunction']);


// User side
Route::middleware(['isUser'])->group(function () {

    Route::post('getDataRate', [FeedbackController::class, 'getDataRate']);
    Route::get('getBookingById', [BookingController::class, 'getBookingById']);


    // my bookings

    Route::get('bookdetails/{id}', [HomesController::class, 'bookdetails'])->middleware('checkRoleId')->name('bookdetails');
    // Route::get('bookdetails/{id}', [HomesController::class, 'bookdetails'])->name('bookdetails');


    // cancelled bookings

    Route::post('/cancelbooking', [CancelledBookingByIdUser::class, 'cancel_by_user']);
    Route::get('/cancelled/{id}', [CancelledBookingByIdUser::class, 'index'])->middleware(['checkRoleId'])->name('user.cancelledbookings');
    Route::get('/completed/{id}', [CompletedBookingByIdUser::class, 'index'])->middleware(['checkRoleId'])->name('user.completedbookings');

    Route::get('/home', [HomeController::class, 'index'])->middleware(['auth', 'verified'])->name('user.dashboard');
    Route::prefix('user')->group(function () {
        // dashboard




        Route::get('getCarPrice', [BookingController::class, 'getCarPrice'])->name('getCarPrice');
        // route::get('admincar', [AdmincarController::class, 'admincar']);
        // route::get('addcar', [AdmincarController::class, 'addcar']);
        // route::post('savecar', [AdmincarController::class, 'savecar']);
        // route::get('editing/{id}', [AdmincarController::class, 'editcar']);
        // route::post('uploadvehicle/{id}', [AdmincarController::class, 'uploadcars']);
        // route::get('delete/{id}', [AdmincarController::class, 'delete']);

        // // Admin User Controller
        // route::get('adduser', [AdminuserController::class, 'adduser']);
        // route::post('saveuser', [AdminuserController::class, 'saveuser']);
        // route::get('editinguser/{id}', [AdminuserController::class, 'edituser']);
        // route::post('updateuser/{id}', [AdminuserController::class, 'updateuser']);
        // route::get('deleteuser/{id}', [AdminuserController::class, 'deleteuser']);


        // get rate data


    });
});






//Homes Controller

route::get('availablecars', [HomesController::class, 'availablecars']);
// route::get('viewcardetails/{id}', [HomesController::class, 'viewcardetails']);
Route::get('viewcardetails/{id}', [HomesController::class, 'viewcardetails'])->name('viewcardetails');
route::get('search', [HomesController::class, 'search']);




//INDEX CONTROLLER PARA SA HOME SA SAKYANAN NGA MA DISPLAY

// route::get('/', [IndexController::class, 'indexcar']);

// PAGAWAS RANI NAMO SA ROUTEGROUP



// Admincar Car Controller
route::get('admincar', [AdmincarController::class, 'admincar']);
route::get('addcar', [AdmincarController::class, 'addcar']);
route::post('savecar', [AdmincarController::class, 'savecar']);
route::get('editing/{id}', [AdmincarController::class, 'editcar']);
route::post('uploadvehicle/{id}', [AdmincarController::class, 'uploadcars']);
route::get('delete/{id}', [AdmincarController::class, 'delete']);

// Admin User Controller
// route::get('adminuser', [AdminuserController::class, 'adminuser']);
route::get('adduser', [AdminuserController::class, 'adduser']);
route::post('saveuser', [AdminuserController::class, 'saveuser']);
route::get('editinguser/{id}', [AdminuserController::class, 'edituser']);
route::post('updateuser/{id}', [AdminuserController::class, 'updateuser']);
// route::get('deleteuser/{id}', [AdminuserController::class, 'deleteuser']);

// // Admin User Controller
// route::get('adduser', [AdminuserController::class, 'adduser']);
// route::post('saveuser', [AdminuserController::class, 'saveuser']);
// route::get('editinguser/{id}', [AdminuserController::class, 'edituser']);
// route::post('updateuser/{id}', [AdminuserController::class, 'updateuser']);
// route::get('deleteuser/{id}', [AdminuserController::class, 'deleteuser']);


// Profile Settings Controller
route::get('myprofile/{id}', [ProfileController::class, 'myprofile']);
route::get('editprofile/{id}', [ProfileController::class, 'editprofile']);
route::post('updateprofile/{id}', [ProfileController::class, 'updateprofile']);





//INDEX CONTROLLER PARA SA HOME SA SAKYANAN NGA MA DISPLAY

// route::get('/', [IndexController::class, 'indexcar']);

// PAGAWAS RANI NAMO SA ROUTEGROUP

// Admincar Car Controller
route::get('admincar', [AdmincarController::class, 'admincar']);
route::get('addcar', [AdmincarController::class, 'addcar']);
route::post('savecar', [AdmincarController::class, 'savecar']);
route::get('editing/{id}', [AdmincarController::class, 'editcar']);
route::post('uploadvehicle/{id}', [AdmincarController::class, 'uploadcars']);
route::get('delete/{id}', [AdmincarController::class, 'delete']);

// Admin User Controller
// route::get('adminuser', [AdminuserController::class, 'adminuser']);
route::get('adduser', [AdminuserController::class, 'adduser']);
route::post('saveuser', [AdminuserController::class, 'saveuser']);
route::get('editinguser/{id}', [AdminuserController::class, 'edituser']);
route::post('updateuser/{id}', [AdminuserController::class, 'updateuser']);
// route::get('deleteuser/{id}', [AdminuserController::class, 'deleteuser']);

// Profile Settings Controller
route::get('myprofile/{id}', [ProfileController::class, 'myprofile']);
route::get('editprofile/{id}', [ProfileController::class, 'editprofile']);
route::post('updateprofile/{id}', [ProfileController::class, 'updateprofile']);


// Feedback query
Route::post('storecomment/', [FeedbackController::class, 'storecomment'])->name('storecomment');
Route::get('feedback', [FeedbackController::class, 'feedback']);

Route::get('view/{id}', [FeedbackController::class, 'view']);
route::get('deletefeedback/{id}', [FeedbackController::class, 'deletefeedback']);

// Booking query
Route::get('bookingform/{id}', [BookingController::class, 'bookingform']);
Route::post('booksave', [BookingController::class, 'bookingsave'])->name('booksave');
Route::get('editdriverbooking/{id}', [BookingController::class, 'editdriverbooking']);
Route::get('viewdriverbooking/{id}', [BookingController::class, 'viewdriverbooking']);
route::post('updateuserbooking', [BookingController::class, 'updateuserbooking'])->name('updateuserbooking');
// Route::get('viewdriverbooking/{id}', [BookingController::class, 'viewdriverbooking'])->name('viewdriverbooking');

// MY BBOOKING SELFDRIVE SIDE
Route::get('viewselfbooking/{id}', [BookingController::class, 'viewselfbooking']);
Route::get('editselfbooking/{id}', [BookingController::class, 'editselfbooking']);
route::post('updateselfbooking', [BookingController::class, 'updateselfbooking'])->name('updateselfbooking');

//  User Drivers query
Route::get('driver', [DriversController::class, 'driver']);

// Drivers query Admin

route::get('admindriver', [DriversController::class, 'admindriver']);
route::get('addriver', [DriversController::class, 'addriver']);
route::post('savingdriver', [DriversController::class, 'savedriver']);
route::get('editdriver/{id}', [DriversController::class, 'editdriver']);
route::post('updatedriver/{id}', [DriversController::class, 'updatedriver']);
route::get('deleteadmin/{id}', [DriversController::class, 'deleteadmin']);

//    user Self drive
Route::get('selfdrive_form/{id}', [SelfdriveController::class, 'selfdrive_form']);
Route::post('selfdrivebook', [SelfdriveController::class, 'selfdrivebook'])->name('selfdrivebook');


// User Booking Details
// Route::get('bookdetails/{id}', [HomesController::class, 'bookdetails'])->name('bookdetails');
Route::get('viewbooking/{id}', [HomesController::class, 'display'])->name('viewbooking');

// Self drives User side Details
Route::get('selfdrive/{id}', [HomesController::class, 'selfdrive'])->name('selfdrive');

// Booking manage Admin Side
route::get('bookingwithdriver', [BookingController::class, 'bookingwithdriver']);
route::get('confirmstatus/{id}', [BookingController::class, 'confirmstatus']);
route::get('rejectstatus/{id}', [BookingController::class, 'rejectstatus']);
Route::get('add-booking-withdriver', [BookingController::class, 'add_booking_withdriver']);
Route::post('store_booking_withdriver', [BookingController::class, 'store_booking_withdriver']);

// ADMIN SIDE ADD SELFDRIVE add booking
Route::post('store_booking_selfdrive', [SelfdriveController::class, 'store_booking_selfdrive']);




route::get('/completedstatus/{id}/{model}', [BookingController::class, 'completedstatus']);
Route::get('/gettotalsales', [BookingController::class, 'total_sales'])->name('gettotalsales');


route::post('topay/', [BookingController::class, 'topay'])->name('to_pay');

//  BOOKING ADMIN SIDE SELFDRIVE
route::get('bookingselfdrive', [BookingController::class, 'bookingselfdrive']);
route::get('selfconfirmstatus/{id}', [BookingController::class, 'selfconfirmstatus']);
route::get('selfrejectstatus/{id}', [BookingController::class, 'selfrejectstatus']);
route::get('selfcompletedstatus/{id}', [BookingController::class, 'selfcompletedstatus']);
route::get('selftopay/{id}', [BookingController::class, 'selftopay']);

// Feeback user side query edit/delete
Route::post('/deleteComment/{id}', [FeedbackController::class, 'deleteComment'])->name('deleteComment');


// reports Controller and routes
// Admin side
Route::middleware(['isAdmin'])->group(function () {

    // dashboard
    // Route::get('dashboard', function () {
    //     return view('admin/dashboard');
    // })->name('admin.dashboard');
    route::get('dashboard', [AdmincarController::class, 'index'])->name('admin.dashboard');

    // // Admincar Car Controller
    // route::get('admincar', [AdmincarController::class, 'admincar']);
    // route::get('addcar', [AdmincarController::class, 'addcar']);
    // route::post('savecar', [AdmincarController::class, 'savecar']);
    // route::get('editing/{id}', [AdmincarController::class, 'editcar']);
    // route::post('uploadvehicle/{id}', [AdmincarController::class, 'uploadcars']);
    // route::get('delete/{id}', [AdmincarController::class, 'delete']);

    // // Admin User Controller

    // route::get('adduser', [AdminuserController::class, 'adduser']);
    // route::post('saveuser', [AdminuserController::class, 'saveuser']);
    // route::get('editinguser/{id}', [AdminuserController::class, 'edituser']);
    // route::post('updateuser/{id}', [AdminuserController::class, 'updateuser']);
    // route::get('deleteuser/{id}', [AdminuserController::class, 'deleteuser']);


    // Admin Reports

    Route::get('bookingreports', IsAdminReportsController::class);
    Route::get('feedbackreports', FeedbackReportsComponent::class);
    Route::get('carreports', CarReportsComponent::class);
    Route::POST('/completedreports', [BookingController::class, 'completed_reports'])->name('getmonth_and_completed_status');


    // i added route for admin booking rejection
    Route::post('booking/reject', [BookingController::class, 'rejectBooking'])->name('reject.booking');
    Route::post('/invoice', [InvoiceConfirmedBookingController::class, 'generateInvoice'])->name('printPdf');

    Route::get('/generate-pdf', [InvoiceConfirmedBookingController::class, 'generateBookingReport'])->name('generate-pdf');
    Route::post('/save-screenshot', [InvoiceConfirmedBookingController::class, 'saveScree
    nshot']);
    Route::get('/take', [InvoiceConfirmedBookingController::class, 'take']);
    // Route::post('/generate-pdf', [PDFController::class, 'generateBookingReport']);


    Route::post('/update-session', [BookingController::class, 'updateSession']);



    // User logs using livewire

    Route::get('userActivity', UserLogs::class);
    // Route::get('userActivity', [UserActivityController::class, 'userActivity']);
    Route::get('adminActivity', [UserActivityController::class, 'adminActivity']);
});

// Admin Profile Settings

route::get('adminprofile', [ProfileController::class, 'adminprofile']);
route::post('updated/{id}', [ProfileController::class, 'updated']);




// DISABLE ENABLE CAR STATUS IN ADMINCAR
route::get('enablecar/{id}', [AdmincarController::class, 'enablecar']);
route::get('disablecar/{id}', [AdmincarController::class, 'disablecar']);


Route::get('/logout', [Auth\LoginController::class, 'logout']);

Route::get('searchFeedback', [FeedbackController::class, 'searchFeedback']);
Route::get('searchUser', [AdminuserController::class, 'searchUser']);
Route::get('mybook/{id}', [HomesController::class, 'mybook']);
route::get('bookwithdriver', [BookingController::class, 'bookwithdriver']);
Route::post('userRemarks', [RemarksController::class, 'userRemarks'])->name('userRemarks');
Route::get('/user/{id}/remarks', [RemarksController::class, 'getUserRemarks']);



















