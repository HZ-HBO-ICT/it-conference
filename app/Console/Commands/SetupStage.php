<?php

namespace App\Console\Commands;

use Exception;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class SetupStage extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:setup {stage}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Set up the database for a specific conference stage';

    private array $availableStages = ['initial', 'company-registration', 'participant-registration'];

    /**
     * Execute the console command.
     * Sets up the database to a stage depending on the argument given.
     */
    public function handle(): void
    {
        $stage = $this->argument('stage');
        if (!in_array($stage, $this->availableStages)) {
            $this->error('Invalid stage! Make sure the stage is one of the following: ' . implode(', ', $this->availableStages));
            exit(1);
        }

        try {
            // Run the commands that always have to be run
            $this->line('Running migrate:fresh...');
            Artisan::call('migrate:fresh');

            $this->line('Inserting the master data...');
            Artisan::call('admin:upsert-master-data');

            $this->line('Syncing permissions...');
            Artisan::call('admin:sync-permissions');

            $this->line('Running seeders...');
            switch ($stage) {
                case 'initial':
                    Artisan::call('db:seed --class=InitialSeeder');
                    break;
                case 'company-registration':
                    Artisan::call('db:seed --class=CompanyRegistrationSeeder');
                    break;
                case 'participant-registration':
                    Artisan::call('db:seed --class=ParticipantRegistrationSeeder');
                    break;
                default:
                    throw new Exception('Invalid Stage was given');
            }

            $this->info("Seeded {$stage} stage successfully!");
        } catch (Exception $exception) {
            $this->error($exception->getMessage());
        }
    }
}
