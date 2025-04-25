<?php

use App\Http\Controllers\CompanyController;
use App\Http\Controllers\Crew\BoothController;
use App\Http\Controllers\Crew\CrewController;
use App\Http\Controllers\Crew\DefaultPresentationController;
use App\Http\Controllers\Crew\EditionController;
use App\Http\Controllers\Crew\FrequentQuestionController;
use App\Http\Controllers\Crew\RoomController;
use App\Http\Controllers\Crew\ScheduleController;
use App\Http\Controllers\Crew\SponsorshipController;
use App\Http\Controllers\Crew\TicketController;
use App\Http\Controllers\Crew\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Hub\ParticipantController;
use App\Http\Controllers\InvitationController;
use App\Http\Controllers\PresentationController;
use App\Http\Controllers\ProgrammeController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\SpeakerController;
use Illuminate\Auth\Middleware\RedirectIfAuthenticated;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Route;

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
Route::middleware([
    RedirectIfAuthenticated::class,
    'edition-activated'
])->group(function () {
    Route::get('/register/participant', [RegistrationController::class, 'showParticipantRegistration'])
        ->name('register.participant');
    Route::get('/register/company', [RegistrationController::class, 'showCompanyRegistration'])
        ->name('register.company');
});

Route::get('/', [HomeController::class, 'index'])->name('welcome');
Route::get('/speakers', [SpeakerController::class, 'index'])->name('speakers.index');
Route::get('/companies', [CompanyController::class, 'index'])->name('companies.index');
Route::get('/companies/{company}', [CompanyController::class, 'show'])->name('companies.show');
Route::get('/faq', [\App\Http\Controllers\FrequentQuestionController::class, 'index'])->name('faq');
Route::view('/contact', 'contact')->name('contact');
Route::post('/contact', function() { return redirect()->back(); })->name('contact.submit');

// routes for registering from invitation
Route::get('/register/team-invitations/{invitation}', [InvitationController::class, 'show'])
    ->middleware(['signed'])->name('registration.page.via.invitation');
Route::post('/register/team-invitations/{invitation}', [InvitationController::class, 'register'])
    ->name('register.via.invitation');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::prefix('/my')->group(function () {
        Route::view('/', 'myhub.home')->name('dashboard');
        Route::get('/feedback', [ParticipantController::class, 'createFeedback'])
            ->name('feedback.create');
        Route::post('/feedback', [ParticipantController::class, 'storeFeedback'])
            ->name('feedback.store');
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

    //route for personal programme
    Route::get('/my/programme', [ParticipantController::class, 'programme'])
        ->name('my.programme');

    Route::post('/my/enroll/{presentation}', [ProgrammeController::class, 'enroll'])
        ->name('my.programme.enroll');

    Route::post('/my/disenroll/{presentation}', [ProgrammeController::class, 'disenroll'])
        ->name('my.programme.disenroll');

    // routes for edition
    Route::get('/moderator/editions', [EditionController::class, 'index'])
        ->name('moderator.editions.index');

    Route::get('/moderator/editions/create', [EditionController::class, 'create'])
        ->name('moderator.editions.create');

    Route::post('/moderator/editions/create', [EditionController::class, 'store'])
        ->name('moderator.editions.store');

    Route::delete('/moderator/editions/{edition}', [EditionController::class, 'destroy'])
        ->name('moderator.editions.destroy');

    Route::get('/moderator/editions/{edition}', [EditionController::class, 'show'])
        ->name('moderator.editions.show');

    Route::post('/moderator/editions/{edition}/activate', [EditionController::class, 'activateEdition'])
        ->name('moderator.editions.activate');
});

// Routes for policy files
Route::get('/files/policies/privacy-policy', function () {
    $path = public_path('files/policies/privacy_policy_1-9-2024.pdf');

    if (file_exists($path)) {
        return Response::file($path);
    }

    abort(404, 'File not found');
})->name('privacy-policy');

Route::get('/files/policies/cookie-statement', function () {
    $path = public_path('files/policies/cookie_statement_1-9-2024.pdf');

    if (file_exists($path)) {
        return Response::file($path);
    }

    abort(404, 'File not found');
})->name('cookie-statement');

Route::get('/files/policies/terms-and-conditions', function () {
    $path = public_path('files/policies/terms_and_conditions_1-9-2024.pdf');

    if (file_exists($path)) {
        return Response::file($path);
    }

    abort(404, 'File not found');
})->name('terms-and-conditions');


//
//    //route for my profile in personal hub
//    Route::get('/my/profile', [HubController::class, 'getProfileInfo'])->name('my-profile');
//

//
//    Route::post('/cohost/{presentation}', [SpeakerController::class, 'cohostPresentation'])
//          ->name('cohost.presentation');
//

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

Route::get('/programme', [ProgrammeController::class, 'index'])
    ->name('programme');

Route::get('/programme/presentation/{presentation}', [ProgrammeController::class, 'show'])
    ->name('programme.presentation.show');



// ===== Routes for crew =====
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    'edition-activated'
])->name('moderator.')->group(function () {
    Route::get('/schedule', [ScheduleController::class, 'index'])
        ->name('schedule.index');
    Route::post('/schedule/reset/{type}', [ScheduleController::class, 'reset'])
        ->name('schedule.reset');
    Route::post('/schedule/publish', [ScheduleController::class, 'publishFinalProgramme'])
        ->name('schedule.publish');

    /*    Route::get('/schedule/timeslots', [TimeslotController::class, 'create'])
            ->name('schedule.timeslots.create');
        Route::post('/schedule/timeslots', [TimeslotController::class, 'store'])
            ->name('schedule.timeslots.store');*/

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

    Route::resource('/moderator/booths', BoothController::class);
    Route::resource('/moderator/faqs', FrequentQuestionController::class);
    Route::post('/moderator/booths/{booth}/approve/{isApproved}', [
        App\Http\Controllers\Crew\BoothController::class, 'approve'
    ])->name('booths.approve');

    Route::get('/moderator/feedback', [\App\Http\Controllers\Crew\FeedbackController::class, 'index'])
        ->name('feedback.index');
    Route::get('/moderator/feedback/{feedback}', [\App\Http\Controllers\Crew\FeedbackController::class, 'show'])
        ->name('feedback.show');

    Route::resource(
        '/moderator/companies',
        App\Http\Controllers\Crew\CompanyController::class
    );
    Route::post('/moderator/companies/{company}/approve/{isApproved}', [
        App\Http\Controllers\Crew\CompanyController::class, 'approve'
    ])->name('companies.approve');

    Route::resource(
        '/moderator/presentations',
        App\Http\Controllers\Crew\PresentationController::class
    );
    Route::post('/moderator/presentations/{presentation}/approve/{isApproved}', [
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
    Route::post('/crew/sponsorships/{company}/approve/{isApproved}', [SponsorshipController::class, 'approve'])
        ->name('sponsorships.approve');

    // ====== Crew routes ========
    Route::get('/moderator/crew', [CrewController::class, 'index'])->name('crew.index');


    Route::resource('/moderator/rooms', RoomController::class);

    Route::get('/moderator/users/{role?}', [UserController::class, 'index'])->name('users.index');

    Route::get('/moderator/tickets', [TicketController::class, 'index'])->name('tickets.index');
});
