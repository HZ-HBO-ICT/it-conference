<?php

namespace App\Notifications;

use App\Mail\GenericNewUpdatesMailable;
use App\Mail\CompanyApprovedMailable;
use App\Models\Team;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NotifyTeamApproved extends Notification
{
    use Queueable;

    private Team $team;

    /**
     * Create a new notification instance.
     */
    public function __construct($team)
    {
        $this->team = $team;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        if ($notifiable->receive_emails) {
            return ['mail', 'database'];
        }

        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable)
    {
        if ($notifiable->id === $this->team->owner->id) {
            return (new CompanyApprovedMailable($this->team))
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
                'text' => "Congratulations, your company is joining us in the IT Conference!",
            ];
        } else {
            return [
                'text' => "The company {$this->team->name} is joining the IT Conference! Meet them there!",
            ];
        }
    }
}
