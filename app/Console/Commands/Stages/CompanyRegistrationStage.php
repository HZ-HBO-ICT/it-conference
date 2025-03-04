<?php

namespace App\Console\Commands\Stages;

use Exception;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class CompanyRegistrationStage extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:company-registration-stage';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Runs the database migrations and seeders to emulate the company registration stage of the conference';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        try {
            Artisan::call('migrate:fresh');
            Artisan::call('admin:upsert-master-data');
            Artisan::call('admin:sync-permissions');
            Artisan::call('db:seed --class=CompanyRegistrationSeeder');

            $this->info('Seeded company registration stage successfully!');
        } catch (Exception $exception) {
            $this->error($exception->getMessage());
        }
    }
}
