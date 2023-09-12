<?php

namespace App\Notifications;

use App\Mail\BoothDisapprovedMailable;
use App\Mail\GenericNewUpdatesMailable;
use App\Mail\SponsorshipApprovedMailable;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Team;

class NotifySponsorshipApproved extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(
        public Team $team
    )
    {
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        dd($notifiable);
        if ($notifiable->receive_emails)
            return ['mail', 'database'];

        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable)
    {
        if ($notifiable->id === $this->team->owner->id) {
            return (new SponsorshipApprovedMailable($this->team))
                ->to($notifiable->email);
        } else {
            return (new GenericNewUpdatesMailable($notifiable))
                ->to($notifiable->email);
        }
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        if ($notifiable->id === $this->team->owner->id) {
            return [
                'text' => "Your sponsorship has been approved and {$this->team->name} is our {$this->team->sponsorTier->name} sponsor",
            ];
        } else {
            return [
                'text' => "The company {$this->team->name} is joining the conference as a {$this->team->sponsorTier->name} sponsor",
            ];
        }
    }
}
