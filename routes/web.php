<?php

use App\Http\Controllers\ContentModeratorController;
use App\Http\Controllers\InvitationController;
use App\Http\Controllers\SpeakerController;
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
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::get('/register/team-invitations/{invitation}', [InvitationController::class, 'show'])
    ->middleware(['signed'])->name('registration.page.via.invitation');

Route::post('/register/team-invitations/{invitation}', [InvitationController::class, 'register'])
    ->name('register.via.invitation');

Route::get('/faq', function () {
    return view('faq');
})->name('faq');

Route::get('/requests/{type}', [ContentModeratorController::class, 'requests'])
    ->name('moderator.requests');

Route::get('/requests/{type}/{id}', [ContentModeratorController::class, 'details'])
    ->name('moderator.request.details');

Route::post('/requests/{type}/{id}/approve/{isApproved}', [ContentModeratorController::class, 'changeApprovalStatus'])
    ->name('moderator.request.approve');

Route::resource('/speakers', SpeakerController::class);

