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
    Route::get('/dashboard/announcements', function () {
        return view('myhub.announcement');
    })->name('announcements');

    Route::get('/dashboard/profile', function () {
        return view('myhub.profile');
    })->name('my-profile');

    Route::get('/dashboard/programme', function () {
        $user = User::where('name', Auth::user()->name)->first();
        $presentations = $user->presentations->sortBy('timeslot.start');

        //dd($presentations);

        return view('myhub.programme', compact('presentations'));
    })->name('my-programme');
});

Route::get('/register/team-invitations/{invitation}', [InvitationController::class, 'show'])
    ->middleware(['signed'])->name('registration.page.via.invitation');

Route::post('/register/team-invitations/{invitation}', [InvitationController::class, 'register'])
    ->name('register.via.invitation');

Route::get('/faq', function () {
    return view('faq');
})->name('faq');

Route::resource('/speakers', SpeakerController::class);

