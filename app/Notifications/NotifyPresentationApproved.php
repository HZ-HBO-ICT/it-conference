<?php

namespace App\Notifications;

use App\Mail\GenericNewUpdatesMailable;
use App\Mail\PresentationApprovedMailable;
use App\Mail\TeamApprovedMailable;
use App\Models\Presentation;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NotifyPresentationApproved extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(public Presentation $presentation)
    {
        //
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
        if ($notifiable->id === $this->presentation->mainSpeaker()->user->id) {
            return (new PresentationApprovedMailable())
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
        if ($notifiable->id === $this->presentation->mainSpeaker()->user->id) {
            return [
                'text' => "Congratulations, your presentation has been approved for the IT Conference!",
            ];
        } else {
            return [
                'text' => "A new presentation is added for the IT Conference!
                 - {$this->presentation->name}! Check it out",
            ];
        }
    }
}
