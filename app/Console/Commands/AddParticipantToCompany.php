<?php

namespace App\Console\Commands;

use App\Actions\Users\AddParticipantToCompanyHandler;
use App\Models\Company;
use App\Models\User;
use Illuminate\Console\Command;

class AddParticipantToCompany extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:add-participant-to-company {email} {company_id} {role=company member}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Adds a participant as a part of a company in case the user registered as stand alone
        even though they are attending with a company.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        activity()->withoutLogs(function () {
            try {
                $user = User::where('email', $this->argument('email'))->firstOrFail();
                $company = Company::findOrFail($this->argument('company_id'));

                (new AddParticipantToCompanyHandler())->execute($user, $company, $this->argument('role'));

                $user->refresh();
                $this->info("You successfully added {$user->email} as part of the {$user->company->name}");
            } catch (\Exception $e) {
                $this->error($e);
            }
        });
    }
}
