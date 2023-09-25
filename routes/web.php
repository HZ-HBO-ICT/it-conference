<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\HubController;
use App\Http\Controllers\InvitationController;
use App\Http\Controllers\PresentationController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\SpeakerController;
use App\Models\Presentation;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\ContentModeratorController;
use App\Http\Controllers\TeamRequestsController;
use App\Http\Controllers\TeamsController;
use App\Http\Controllers\TimeslotController;
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

Route::get('/', [HomeController::class, 'index'])->name('welcome');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    //route for announcements
    Route::get('/my', [HubController::class, 'getConferenceHome'])->name('announcements');

    //route for my profile in personal hub
    Route::get('/myconference/profile', [HubController::class, 'getProfileInfo'])->name('my-profile');

    //route for personal programme
    Route::get('/myconference/programme', [HubController::class, 'getProgramme'])->name('my-programme');

    Route::post('/cohost/{presentation}', [SpeakerController::class, 'cohostPresentation'])->name('cohost.presentation');

    //route for disenrolling from a presentation
    Route::get('/myconference/programme/{presentationId}', [HubController::class, 'detachParticipation'])->name('destroy-participant');

    Route::get('/speakers/request', [PresentationController::class, 'create'])
        ->name('speakers.request.presentation');
    Route::post('/speakers/request', [PresentationController::class, 'store'])
        ->name('speakers.request.process');

    Route::get('/presentations/{presentation}', [PresentationController::class, 'show'])
        ->name('presentations.show');

    Route::get('/presentations/{presentation}/edit', [PresentationController::class, 'edit'])
        ->name('presentations.edit');

    Route::put('/presentations/{presentation}/edit', [PresentationController::class, 'update'])
        ->name('presentations.update');
});

Route::get('/register/team-invitations/{invitation}', [InvitationController::class, 'show'])
    ->middleware(['signed'])->name('registration.page.via.invitation');

Route::post('/register/team-invitations/{invitation}', [InvitationController::class, 'register'])
    ->name('register.via.invitation');

Route::get('/company-representative-invitation/{invitation}', [InvitationController::class, 'companyRepShow'])
    ->middleware(['signed'])->name('company-rep.invitation');
Route::post('/company-representative-invitation/{invitation}', [InvitationController::class, 'companyRepStore'])
    ->name('company-rep.registration');

Route::get('/faq', function () {
    return view('faq');
})->name('faq');

Route::get('/programme', [ScheduleController::class, 'index'])
    ->name('programme');

Route::get('/speakers', [SpeakerController::class, 'index'])
    ->name('speakers.index');

Route::get('/teams/{team}/requests', [TeamRequestsController::class, 'index'])->name('teams.requests');

Route::get('/companies', [TeamsController::class, 'index'])->name('companies');

Route::get('/contact', function () {
    return view('contact');
})->name('contact');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    'moderator'
])->group(function () {
    Route::get('/requests/{type}', [ContentModeratorController::class, 'requests'])
        ->name('moderator.requests');

    Route::get('/requests/{type}/{id}', [ContentModeratorController::class, 'details'])
        ->name('moderator.request.details');

    Route::post('/requests/teams/{team}/approve/{isApproved}',
        [ContentModeratorController::class, 'changeApprovalStatusOfTeam'])
        ->name('moderator.request.teams.approve');

    Route::post('/requests/booths/{booth}/approve/{isApproved}',
        [ContentModeratorController::class, 'changeApprovalStatusOfBooth'])
        ->name('moderator.request.booths.approve');

    Route::post('/requests/sponsorships/{team}/approve/{isApproved}',
        [ContentModeratorController::class, 'changeApprovalStatusOfSponsorship'])
        ->name('moderator.request.sponsorships.approve');

    Route::post('/requests/presentations/{presentation}/approve/{isApproved}',
        [ContentModeratorController::class, 'changeApprovalStatusOfPresentation'])
        ->name('moderator.request.presentations.approve');

    Route::get('/schedule/overview', [ScheduleController::class, 'overview'])
        ->name('moderator.schedule.overview');

    // TODO: Fix with a post request instead
    Route::get('/schedule/draft', [ScheduleController::class, 'generate'])
        ->name('moderator.schedule.draft');

    Route::get('/schedule/timeslots', [TimeslotController::class, 'create'])
        ->name('moderator.schedule.timeslots.create');
    Route::post('/schedule/timeslots', [TimeslotController::class, 'store'])
        ->name('moderator.schedule.timeslots.store');

    Route::get('/schedule/presentations-for-scheduling', [ScheduleController::class, 'presentationsForScheduling'])
        ->name('moderator.presentations-for-scheduling');
    Route::get('/schedule/{presentation}', [ScheduleController::class, 'schedulePresentation'])
        ->name('moderator.schedule.presentation');
    Route::post('/schedule/{presentation}', [ScheduleController::class, 'storeSchedulePresentation'])
        ->name('moderator.schedule.presentation.store');

    Route::resource('/rooms', RoomController::class);

    Route::get('/moderator/list/{type}', [ContentModeratorController::class, 'showList'])
        ->name('moderator.list');
});
