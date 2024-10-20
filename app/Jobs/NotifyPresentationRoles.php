<?php

namespace App\Jobs;

use App\Models\Presentation;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class NotifyPresentationRoles implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(
        public string $receiver,
        public Presentation $presentation,
        public string $emailTemplate,
    ) {
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        if (!$this->presentation->is_approved) {
            return;
        }

        $users = collect();
        if ($this->receiver == 'crew') {
            $users = User::role(['event organizer', 'speakers supervisor', 'assistant organizer'])->get();
        } else if ($this->receiver == 'speaker') {
            $users = $this->presentation->speakers;
        }

        // Send emails to the users
        foreach ($users as $user) {
            Mail::to($user->email)->send(new $this->emailTemplate($user, $this->presentation));
        }
    }
}
