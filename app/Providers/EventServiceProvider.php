<?php

namespace App\Providers;

use App\Events\BoothApproved;
use App\Events\BoothDisapproved;
use App\Events\PresentationApproved;
use App\Events\PresentationDisapproved;
use App\Events\SponsorshipApproved;
use App\Events\SponsorshipDisapproved;
use App\Events\TeamApproved;
use App\Events\TeamDisapproved;
use App\Listeners\HandleBoothApproved;
use App\Listeners\HandleBoothDisapproved;
use App\Listeners\HandlePresentationApproved;
use App\Listeners\HandlePresentationDisapproved;
use App\Listeners\HandleSponsorshipApproved;
use App\Listeners\HandleSponsorshipDisapproved;
use App\Listeners\HandleTeamApproved;
use App\Listeners\HandleTeamDisapproved;
use App\Listeners\SendTeamApprovedNotifications;
use App\Mail\BoothDisapprovedMailable;
use App\Models\Booth;
use App\Observers\BoothObserver;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
    ];

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
        Booth::observe(BoothObserver::class);
//        Event::listen(
//            BoothApproved::class,
//            [HandleBoothApproved::class, 'handle']
//        );
//        Event::listen(
//            BoothDisapproved::class,
//            [HandleBoothDisapproved::class, 'handle']
//        );
        Event::listen(
            TeamApproved::class,
            [HandleTeamApproved::class, 'handle']
        );
        Event::listen(
            TeamDisapproved::class,
            [HandleTeamDisapproved::class, 'handle']
        );
        Event::listen(
            SponsorshipApproved::class,
            [HandleSponsorshipApproved::class, 'handle']
        );
        Event::listen(
            SponsorshipDisapproved::class,
            [HandleSponsorshipDisapproved::class, 'handle']
        );
        Event::listen(
            PresentationApproved::class,
            [HandlePresentationApproved::class, 'handle']
        );
        Event::listen(
            PresentationDisapproved::class,
            [HandlePresentationDisapproved::class, 'handle']
        );
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
