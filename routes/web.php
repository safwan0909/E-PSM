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


Route::get('/', function () {
    $logged_user = session()->get('logged_user');
    $user_type = session()->get('user_type');


    if (!$logged_user) {
        return view('welcome');
    } else {

        if ($user_type == 'Student') {
            return redirect('studentprofile');
        } elseif ($user_type == 'Supervisor') {
            return redirect('supervisorprofile');
        } elseif ($user_type == 'Technician') {
            return redirect('technicianprofile');
        }
    }
});

Route::get('/home', function () {
    return view('homepage');
});

Route::view('register', 'register');
Route::view('forgot', 'forgot');

Route::post('user_login', 'UsersController@login');
Route::post('user_register', 'UsersController@register');

Route::post('user_reset', 'UsersController@resetpassword');

Route::get('/logout', 'UsersController@logout');

// Route::get('/details', function () {
//     //getting user logged session
//     $logged_user = session()->get('logged_user');

//     if (!$logged_user) {
//         return redirect('/');
//     } else {
//         return view('semakan.semak_details');
//     }
// })->name('details');

//Profile
use App\Http\Controllers\studentController;

Route::get('studentprofile', [studentController::class, 'index']);
Route::get('STDedit', [studentController::class, 'editprofile']);
Route::post('STD_update', 'studentController@updateprofile');

use App\Http\Controllers\supervisorController;

Route::get('supervisorprofile', [supervisorController::class, 'index']);
Route::get('SVedit', [supervisorController::class, 'editprofile']);
Route::post('SV_update', 'supervisorController@update_profile');
// url tak boleh sama tapi ada cara kalau nak pakai url sama

use App\Http\Controllers\technicianController;

Route::get('technicianprofile', [technicianController::class, 'index']);
Route::get('TECHedit', [technicianController::class, 'editprofile']);
Route::post('TECH_update', 'technicianController@update_profile');

use App\Http\Controllers\coordinatorController;

Route::get('coordinatorprofile', [coordinatorController::class, 'index']);
Route::get('COedit', [coordinatorController::class, 'editprofile']);
Route::post('CO_update', 'coordinatorController@update_profile');

//MeetingBooking
use App\Http\Controllers\MeetingController;

Route::get('AddMeetingBooking', [MeetingController::class, 'MeetingInterface']);//student add meeting booking
Route::get('ViewMeetingBooking', [MeetingController::class, 'viewMeetingBooking']); //student view meeting
Route::get('EditMeetingBooking', [MeetingController::class, 'editMeetingBooking']); //student edit meetig booking
Route::get('RetriveMeeting', [MeetingController::class, 'retriveMeeting']); //sv view meeting list detail
Route::get('AddMeetingStatus', [MeetingController::class, 'addMeetingStatus']); //sv add meeting status

Route::post('MeetingBooking', 'MeetingController@addMeetingBooking');


//Logbook
use App\Http\Controllers\LogbookController;

Route::get('LogbookStudent', [LogbookController::class, 'logbookview']);

//SV Hunting
use App\Http\Controllers\SvHuntingController;

Route::get('ViewSvList',[SvHuntingController::class, 'viewSVList']); //View sv list
Route::get('/search','SvHuntingController@search');

Route::get('Addsv',[SvHuntingController::class, 'addsv']);
Route::get('ApplySV', [SvHuntingController::class, 'applySV']);
Route::get('ViewApplicationStatus',[SvHuntingController::class, 'viewApplicationStatus']);


// manage inventory
use App\Http\Controllers\ManageInventoryController;

Route::group(['prefix' => 'manage-inventory', 'as' => 'manage-inventory.'], function (){
    Route::get('/items', [ManageInventoryController::class,'viewAll'])
        ->name('view-all');
    Route::get('/my-items', [ManageInventoryController::class, 'viewOne'])
        ->name('view-one');

    Route::post('/add', [ManageInventoryController::class, 'store'])
        ->name('store');

    Route::get('/show/{item_id}', [ManageInventoryController::class, 'show'])
        ->name('show');

    Route::get('/edit/{item_id}', [ManageInventoryController::class, 'edit'])
        ->name('edit');
    Route::post('/update/{item_id}', [ManageInventoryController::class, 'update'])
        ->name('update');
    Route::get('/delete/{item_id}', [ManageInventoryController::class, 'destroy'])
        ->name('destroy');

    Route::post('/approval/{item_id}', [ManageInventoryController::class, 'setApproval'])
        ->name('approval');
});


//Route::get('Addsv', [SvHuntingController::class, 'SvHuntingInterface']);
//Route::get('Addsv',[SvHuntingController::class, 'addsv']);
//Route::get('ApplySV', [SvHuntingController::class, 'applySV']);
//Route::get('ViewApplicationStatus',[SvHuntingController::class, 'viewApplicationStatus']);
//Route::get('apply', [SVHuntingController::class, 'applySV']);


