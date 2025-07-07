<?php

namespace App\Console\Commands;

use Exception;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class SetupProduction extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:setup-production';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     * Sets up the app for production.
     */
    public function handle(): void
    {
        try {
            $this->line('Inserting the master data...');
            Artisan::call('admin:upsert-master-data');

            $this->line('Syncing permissions...');
            Artisan::call('admin:sync-permissions');

            $this->line('Setting up storage link...');
            Artisan::call('storage:link');
        } catch (Exception $e) {
            $this->error($e->getMessage());
        }
    }
}
