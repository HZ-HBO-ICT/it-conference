<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Exception;

class CreateTicketsForVerifiedUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'admin:create-tickets-for-verified-users';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creates tickets for all the users who verified their emails and are not crew.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        try {
            foreach (User::verified()->get() as $user) {
                $user->createTicket();
            }

            $this->info('Tickets were created successfully.');
        } catch (Exception) {
            $this->error('The emails could not be marked as confirmed');
        }
    }
}
