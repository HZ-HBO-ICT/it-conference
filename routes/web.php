<?php

use App\Http\Controllers\ContentModerator\ContentModeratorController;
use App\Http\Controllers\ContentModerator\DefaultPresentationController;
use App\Http\Controllers\ContentModerator\RoomController;
use App\Http\Controllers\ContentModerator\ScheduleController;
use App\Http\Controllers\ContentModerator\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\HubController;
use App\Http\Controllers\InvitationController;
use App\Http\Controllers\PresentationController;
use App\Http\Controllers\ProgrammeController;
use App\Http\Controllers\SpeakerController;
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
    //route for announcements
    Route::get('/my', [HubController::class, 'getConferenceHome'])->name('announcements');

    //route for my profile in personal hub
    Route::get('/my/profile', [HubController::class, 'getProfileInfo'])->name('my-profile');

    //route for personal programme
    Route::get('/my/programme', [HubController::class, 'programme'])
        ->name('my.programme');

    Route::post('/cohost/{presentation}', [SpeakerController::class, 'cohostPresentation'])->name('cohost.presentation');

    //route for disenrolling from a presentation
    Route::get('/my/programme/{presentationId}', [HubController::class, 'detachParticipation'])->name('destroy-participant');

    Route::post('/my/enroll/{presentation}', [HubController::class, 'enroll'])
        ->name('my.programme.enroll');

    Route::post('/my/disenroll/{presentation}', [HubController::class, 'disenroll'])
        ->name('my.programme.disenroll');

    Route::get('/speakers/request', [PresentationController::class, 'create'])
        ->name('speakers.request.presentation');
    Route::post('/speakers/request', [PresentationController::class, 'store'])
        ->name('speakers.request.process');

    Route::get('/presentations/{presentation}', [PresentationController::class, 'show'])
        ->name('presentations.show');

    Route::put('/presentations/{presentation}/edit', [PresentationController::class, 'update'])
        ->name('presentations.update');

    Route::delete('/presentations/{presentation}', [PresentationController::class, 'destroy'])
        ->name('presentations.destroy');
});

Route::get('/register/team-invitations/{invitation}', [InvitationController::class, 'show'])
    ->middleware(['signed'])->name('registration.page.via.invitation');
Route::post('/register/team-invitations/{invitation}', [InvitationController::class, 'register'])
    ->name('register.via.invitation');

Route::get('/company-representative-invitation/{invitation}', [InvitationController::class, 'companyRepShow'])
    ->middleware(['signed'])->name('company-rep.invitation');
Route::post('/company-representative-invitation/{invitation}', [InvitationController::class, 'companyRepStore'])
    ->name('company-rep.registration');

Route::get('/user/invitation/{invitation}', [InvitationController::class, 'userShow'])
    ->middleware(['signed'])->name('user.invitation');
Route::post('/user/invitation/{invitation}', [InvitationController::class, 'userStore'])
    ->name('user.invitation.registration');

Route::get('/faq', function () {
    return view('faq');
})->name('faq');

Route::get('/programme', [ProgrammeController::class, 'index'])
    ->name('programme');

Route::get('/programme/presentation/{presentation}', [ProgrammeController::class, 'show'])
    ->name('programme.presentation.show');

Route::get('/speakers', [SpeakerController::class, 'index'])
    ->name('speakers.index');

Route::get('/teams/{team}/requests', [TeamRequestsController::class, 'index'])->name('teams.requests');

Route::get('/companies', [TeamsController::class, 'index'])->name('companies');
Route::get('/companies/{team}', [TeamsController::class, 'show'])->name('companies.show');

Route::get('/contact', function () {
    return view('contact');
})->name('contact');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    'moderator'
])->name('moderator.')->group(function () {
    Route::get('/requests/{type}', [ContentModeratorController::class, 'requests'])
        ->name('requests');

    Route::get('/requests/{type}/{id}', [ContentModeratorController::class, 'details'])
        ->name('request.details');

    Route::post('/requests/teams/{team}/approve/{isApproved}',
        [ContentModeratorController::class, 'changeApprovalStatusOfTeam'])
        ->name('request.teams.approve');

    Route::post('/requests/booths/{booth}/approve/{isApproved}',
        [ContentModeratorController::class, 'changeApprovalStatusOfBooth'])
        ->name('request.booths.approve');

    Route::post('/requests/sponsorships/{team}/approve/{isApproved}',
        [ContentModeratorController::class, 'changeApprovalStatusOfSponsorship'])
        ->name('request.sponsorships.approve');

    Route::post('/requests/presentations/{presentation}/approve/{isApproved}',
        [ContentModeratorController::class, 'changeApprovalStatusOfPresentation'])
        ->name('request.presentations.approve');

    Route::get('/schedule/overview', [ScheduleController::class, 'overview'])
        ->name('schedule.overview');

    Route::post('/schedule/draft', [ScheduleController::class, 'generate'])
        ->name('schedule.draft');

    Route::get('/schedule/timeslots', [TimeslotController::class, 'create'])
        ->name('schedule.timeslots.create');
    Route::post('/schedule/timeslots', [TimeslotController::class, 'store'])
        ->name('schedule.timeslots.store');

    Route::get('/schedule/presentations-for-scheduling', [ScheduleController::class, 'presentationsForScheduling'])
        ->name('presentations-for-scheduling');
    Route::get('/schedule/{presentation}', [ScheduleController::class, 'schedulePresentation'])
        ->name('schedule.presentation');
    Route::post('/schedule/{presentation}', [ScheduleController::class, 'storeSchedulePresentation'])
        ->name('schedule.presentation.store');

    Route::get('/schedule/create/{event}', [DefaultPresentationController::class, 'create'])
        ->name('schedule.default.presentation.create');
    Route::post('/schedule/create/opening', [DefaultPresentationController::class, 'storeOpening'])
        ->name('schedule.store.opening');
    Route::post('/schedule/create/closing', [DefaultPresentationController::class, 'storeClosing'])
        ->name('schedule.store.closing');
    Route::get('/schedule/edit/{event}', [DefaultPresentationController::class, 'edit'])
        ->name('schedule.default.presentation.edit');

    Route::get('/moderator/list/{type}', [ContentModeratorController::class, 'showList'])
        ->name('list');

    Route::resource('/moderator/booths',
        App\Http\Controllers\ContentModerator\BoothController::class);
    Route::post('/moderator/booths/{booth}/approve', [
        App\Http\Controllers\ContentModerator\BoothController::class, 'approve'
    ])->name('booths.approve');

    Route::resource('/moderator/companies',
        App\Http\Controllers\ContentModerator\CompanyController::class);
    Route::post('/moderator/companies/{team}/approve', [
        App\Http\Controllers\ContentModerator\CompanyController::class, 'approve'
    ])->name('companies.approve');

    Route::resource('/moderator/presentations',
        App\Http\Controllers\ContentModerator\PresentationController::class);
    Route::post('/moderator/presentations/{presentation}/approve', [
        App\Http\Controllers\ContentModerator\PresentationController::class, 'approve'
    ])->name('presentations.approve');

    Route::resource('/moderator/sponsors',
        App\Http\Controllers\ContentModerator\SponsorshipController::class);
    Route::post('/moderator/sponsors/{sponsor}/approve', [
        App\Http\Controllers\ContentModerator\SponsorshipController::class, 'approve'
    ])->name('sponsors.approve');

    Route::resource('/moderator/rooms', RoomController::class);

    Route::resource('/moderator/users', UserController::class);
});
