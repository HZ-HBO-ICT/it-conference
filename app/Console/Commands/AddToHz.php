<?php

namespace App\Console\Commands;

use App\Models\Team;
use App\Models\User;
use Illuminate\Console\Command;
use Exception;
use Laravel\Jetstream\Contracts\AddsTeamMembers;

class AddToHz extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'admin:add-to-hz {email}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Adds the person with the given email to the HZ team';

    /**
     * Execute the console command.
     * @throws Exception
     */
    public function handle()
    {
        $userEmail = $this->argument('email');
        $user = User::where('email', $userEmail)->first();

        if (!$user) {
            $this->error('Adding to HZ team failed. User with such email does not exist');
            return;
        }

        $teamHz = Team::where('name', 'HZ University of Applied Sciences')->first();
        if (!$teamHz) {
            $this->error('Adding to HZ team failed. Team HZ seems to be missing');
            return;
        }

        if ($user->currentTeam) {
            $this->error("Seems that {$user->name} (email: {$user->email}) is already a part from a company");
            return;
        }

        try {

            app(AddsTeamMembers::class)->add(
                $teamHz->owner,
                $teamHz,
                $user->email,
                'speaker'
            );
            $user->switchTeam($teamHz);

            $this->info("You successfully added {$user->name} (email: {$user->email}) to the HZ team");
        } catch (Exception) {
            $this->error("Seems that there was an issue in adding {$user->name} (email: {$user->email}) to HZ");
        }
    }
}
