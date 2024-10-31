<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Auth\Events\Verified;
use Illuminate\Console\Command;
use Exception;

class ConfirmAllEmails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'admin:confirm-all-emails';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Marks the emails of all registered users as confirmed';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        try {
            User::all()->each(function ($user) {
                $user->update([
                    'email_verified_at' => now()->timestamp
                ]);

                $user->createTicket();
            });

            $this->info('All emails are marked as confirmed successfully');
        } catch (Exception) {
            $this->error('The emails could not be marked as confirmed');
        }
    }
}
