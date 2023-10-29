<?php

namespace App\Console\Commands;

use App\Models\Presentation;
use App\Models\Speaker;
use App\Models\User;
use Illuminate\Console\Command;

class AddSpeakerToPresentation extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:add-speaker-to-presentation {email} {presentation}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Adds speaker (based on their email) as a cohost to a presentation (based on the id)
        created by a fellow team member';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $userEmail = $this->argument('email');
        $user = User::where('email', $userEmail)->first();

        if (!$user) {
            $this->error('User with such email does not exist');
            return;
        }

        if ($user->speaker) {
            $this->error('The user already has a presentation');
            return;
        }

        $presentationId = $this->argument('presentation');
        $presentation = Presentation::find($presentationId);

        if (!$presentation) {
            $this->error('Presentation with this ID does not exist');
            return;
        }

        if ($presentation->mainSpeaker()->user->currentTeam->id != $user->currentTeam->id) {
            $this->error('The presentation is not created by the team of the passed user');
            return;
        }

        $team = $presentation->mainSpeaker()->user->currentTeam;

        if (!$team->users->first(function ($teamMember) use ($user) {
            return $teamMember->id === $user->id;
        })) {
            $user->currentTeam->users()->attach(
                $user, ['role' => 'speaker']
            );
        }

        $speaker = Speaker::create([
            'user_id' => $user->id,
            'presentation_id' => $presentation->id,
            'is_main_speaker' => 0,
            'is_approved' => 1
        ]);

        if ($speaker) {
            $this->info("You successfully added {$user->name} (email: {$user->email}) to be a speaker of {$presentation->name}");
        } else {
            $this->error("Seems that there was an issue in adding {$user->name} (email: {$user->email}) to be a speaker for {$presentation->name}");
        }
    }
}
