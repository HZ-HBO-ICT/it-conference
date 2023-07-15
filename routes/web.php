<?php

use App\Http\Controllers\HubController;
use App\Http\Controllers\InvitationController;
use App\Http\Controllers\SpeakerController;
use App\Models\Presentation;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

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
    //route for announcements
    Route::get('/dashboard/announcements', [HubController::class, 'getAnnouncements'])->name('announcements');

    //route for my profile in personal hun
    Route::get('/dashboard/profile', [HubController::class, 'getProfileInfo'])->name('my-profile');

    //route for personal programme
    Route::get('/dashboard/programme', [HubController::class, 'getProgramme'])->name('my-programme');

    //route for disenrolling from a presentation
    Route::get('/dashboard/programme/{presentationId}', [HubController::class, 'detachParticipation'])->name('destroy-participant');
});

Route::get('/register/team-invitations/{invitation}', [InvitationController::class, 'show'])
    ->middleware(['signed'])->name('registration.page.via.invitation');

Route::post('/register/team-invitations/{invitation}', [InvitationController::class, 'register'])
    ->name('register.via.invitation');

Route::get('/faq', function () {
    return view('faq');
})->name('faq');

Route::resource('/speakers', SpeakerController::class);

