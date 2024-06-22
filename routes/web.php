<?php

use App\Http\Controllers\CompanyController;
use App\Http\Controllers\Crew\BoothController;
use App\Http\Controllers\Crew\CrewController;
use App\Http\Controllers\Crew\DefaultPresentationController;
use App\Http\Controllers\Crew\RoomController;
use App\Http\Controllers\Crew\ScheduleController;
use App\Http\Controllers\Crew\SponsorshipController;
use App\Http\Controllers\Crew\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Hub\HubController;
use App\Http\Controllers\InvitationController;
use App\Http\Controllers\PresentationController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\SpeakerController;
use Illuminate\Support\Facades\Route;

// use App\Http\Controllers\ProgrammeController;

/*Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});*/

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

// ===== Routes for registration =====
Route::get('/register/participant', [RegistrationController::class, 'showParticipantRegistration'])
    ->name('register.participant');
Route::get('/register/company', [RegistrationController::class, 'showCompanyRegistration'])
    ->name('register.company');
Route::get('/register/team-invitations/{invitation}', [InvitationController::class, 'show'])
    ->middleware(['signed'])->name('registration.page.via.invitation');
Route::post('/register/team-invitations/{invitation}', [InvitationController::class, 'register'])
    ->name('register.via.invitation');


Route::get('/', [HomeController::class, 'index'])->name('welcome');
Route::get('/speakers', [SpeakerController::class, 'index'])->name('speakers.index');
Route::get('/companies', [CompanyController::class, 'index'])->name('companies.index');
Route::view('/faq', 'faq')->name('faq');
Route::view('/contact', 'contact')->name('contact');

//Route::get('/teams/{team}/requests', [TeamRequestsController::class, 'index'])->name('teams.requests');
//
//Route::get('/companies/{team}', [TeamsController::class, 'show'])->name('companies.show');
//
//
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::prefix('/my')->group(function () {
        Route::get('/', [HubController::class, 'dashboard'])->name('dashboard');
        Route::get('/company/details', [\App\Http\Controllers\Hub\CompanyController::class, 'details'])
            ->name('company.details');
        Route::get('/company/requests', [\App\Http\Controllers\Hub\CompanyController::class, 'requests'])
            ->name('company.requests');
    });

    Route::get('/speakers/request', [PresentationController::class, 'create'])
        ->name('presentations.create');
    Route::post('/speakers/request', [PresentationController::class, 'store'])
        ->name('presentations.store');

    Route::get('/presentations/{presentation}', [PresentationController::class, 'show'])
        ->name('presentations.show');
    Route::delete('/presentations/{presentation}', [PresentationController::class, 'destroy'])
        ->name('presentations.destroy');
});
//
//    //route for my profile in personal hub
//    Route::get('/my/profile', [HubController::class, 'getProfileInfo'])->name('my-profile');
//
//    //route for personal programme
//    Route::get('/my/programme', [HubController::class, 'programme'])
//        ->name('my.programme');
//
//    Route::post('/cohost/{presentation}', [SpeakerController::class, 'cohostPresentation'])
//          ->name('cohost.presentation');
//
//    Route::post('/my/enroll/{presentation}', [EnrollmentController::class, 'enroll'])
//        ->name('my.programme.enroll');
//
//    Route::post('/my/disenroll/{presentation}', [EnrollmentController::class, 'disenroll'])
//        ->name('my.programme.disenroll');
//
//
//    Route::get('/presentations/{presentation}', [PresentationController::class, 'show'])
//        ->name('presentations.show');
//
//    Route::put('/presentations/{presentation}/edit', [PresentationController::class, 'update'])
//        ->name('presentations.update');
//

//});
//
//
//Route::get('/company-representative-invitation/{invitation}', [InvitationController::class, 'companyRepShow'])
//    ->middleware(['signed'])->name('company-rep.invitation');
//Route::post('/company-representative-invitation/{invitation}', [InvitationController::class, 'companyRepStore'])
//    ->name('company-rep.registration');
//
//Route::get('/user/invitation/{invitation}', [InvitationController::class, 'userShow'])
//    ->middleware(['signed'])->name('user.invitation');
//Route::post('/user/invitation/{invitation}', [InvitationController::class, 'userStore'])
//    ->name('user.invitation.registration');
//

//Route::get('/programme', [ProgrammeController::class, 'index'])
//    ->name('programme');
//
//Route::get('/programme/presentation/{presentation}', [ProgrammeController::class, 'show'])
//    ->name('programme.presentation.show');
//

// ===== Routes for crew =====
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->name('moderator.')->group(function () {
    Route::get('/requests/{type}', [CrewController::class, 'requests'])
        ->name('requests');

    Route::get('/requests/{type}/{id}', [CrewController::class, 'details'])
        ->name('request.details');

    Route::post(
        '/requests/teams/{team}/approve/{isApproved}',
        [CrewController::class, 'changeApprovalStatusOfTeam']
    )
        ->name('request.teams.approve');

    Route::post(
        '/requests/booths/{booth}/approve/{isApproved}',
        [CrewController::class, 'changeApprovalStatusOfBooth']
    )
        ->name('request.booths.approve');

    Route::post(
        '/requests/sponsorships/{team}/approve/{isApproved}',
        [CrewController::class, 'changeApprovalStatusOfSponsorship']
    )
        ->name('request.sponsorships.approve');

    Route::post(
        '/requests/presentations/{presentation}/approve/{isApproved}',
        [CrewController::class, 'changeApprovalStatusOfPresentation']
    )
        ->name('request.presentations.approve');

    Route::get('/schedule/overview', [ScheduleController::class, 'overview'])
        ->name('schedule.overview');

    Route::post('/schedule/draft', [ScheduleController::class, 'generate'])
        ->name('schedule.draft');

    /*    Route::get('/schedule/timeslots', [TimeslotController::class, 'create'])
            ->name('schedule.timeslots.create');
        Route::post('/schedule/timeslots', [TimeslotController::class, 'store'])
            ->name('schedule.timeslots.store');*/

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

    Route::get('/moderator/list/{type}', [CrewController::class, 'showList'])
        ->name('list');

    Route::resource('/moderator/booths', BoothController::class);
    Route::post('/moderator/booths/{booth}/approve', [
        App\Http\Controllers\Crew\BoothController::class, 'approve'
    ])->name('booths.approve');

    Route::resource(
        '/moderator/companies',
        App\Http\Controllers\Crew\CompanyController::class
    );
    Route::post('/moderator/companies/{company}/approve', [
        App\Http\Controllers\Crew\CompanyController::class, 'approve'
    ])->name('companies.approve');

    Route::resource(
        '/moderator/presentations',
        App\Http\Controllers\Crew\PresentationController::class
    );
    Route::post('/moderator/presentations/{presentation}/approve', [
        App\Http\Controllers\Crew\PresentationController::class, 'approve'
    ])->name('presentations.approve');

    // ====== Sponsorship routes ======
    Route::get('/crew/sponsorships', [SponsorshipController::class, 'index'])
        ->name('sponsorships.index');
    Route::get('/crew/sponsorships/create', [SponsorshipController::class, 'create'])
        ->name('sponsorships.create');
    Route::get('/crew/sponsorships/{company}', [SponsorshipController::class, 'show'])
        ->name('sponsorships.show');
    Route::post('/crew/sponsorships', [SponsorshipController::class, 'store'])
        ->name('sponsorships.store');
    Route::delete('/crew/sponsorships/{company}', [SponsorshipController::class, 'destroy'])
        ->name('sponsorships.delete');
    Route::post('/crew/sponsorships/{company}/approve', [SponsorshipController::class, 'approve'])
        ->name('sponsorships.approve');

    Route::resource('/moderator/rooms', RoomController::class);

    Route::resource('/moderator/users', UserController::class);
});
