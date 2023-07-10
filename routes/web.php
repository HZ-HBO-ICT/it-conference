<?php

use App\Http\Controllers\SpeakerController;
use App\Models\Team;
use Illuminate\Support\Facades\Route;
use Laravel\Jetstream\TeamInvitation as TeamInvitationModel;

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

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::get('/register/team-invitations/{invitation}', function (TeamInvitationModel $invitation) {
    return view('auth.registration-via-invitation', compact('invitation'));
})->middleware(['signed'])->name('registration.via.invitation');

Route::get('/faq', function () {
    return view('faq');
})->name('faq');

Route::resource('/speakers', SpeakerController::class);

