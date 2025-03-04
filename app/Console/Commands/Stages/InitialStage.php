<?php

namespace App\Console\Commands\Stages;

use Exception;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class InitialStage extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:initial-stage';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Runs the database migrations and seeders to emulate the initial stage of the conference';

    /**
     * Execute the console command.
     * This command seeds the database to mimic the initial (clean) stage of the conference
     */
    public function handle(): void
    {
        try {
            Artisan::call('migrate:fresh --force');
            Artisan::call('admin:upsert-master-data');
            Artisan::call('admin:sync-permissions');
            Artisan::call('db:seed --class=InitialSeeder --force');

            $this->info('Seeded initial stage successfully!');
        } catch (Exception $exception) {
            $this->error($exception->getMessage());
        }
    }
}
