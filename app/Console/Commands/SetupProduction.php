<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use function Laravel\Prompts\multiselect;
use function Laravel\Prompts\confirm;

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
    protected $description = 'Starts a wizard to setup or alter the production environment';

    /**
     * Array of the commands that can be chosen.
     * @var array<string>
     */
    private array $commands = ['migrate:fresh', 'admin:upsert-master-data', 'admin:sync-permissions', 'storage:link'];

    /**
     * Execute the console command.
     * A wizard that helps to set up the application for production.
     */
    public function handle(): void
    {
        $checkFirstDeployment = confirm(
            'Is this the first deployment of the year?',
            false,
            'Yes',
            'No'
        );

        $this->line('Checking for pending migrations...');

        if ($this->checkPendingMigrations()) {
            $this->line("Found {$this->checkPendingMigrations()} pending migrations.");
            array_push($this->commands, 'migrate');
        } else {
           $this->line("No pending migrations found");
        }

        if (!$checkFirstDeployment) {
            array_shift($this->commands);
        }

        $commandsToExecute = multiselect('What commands do you want to run?', $this->commands);

        foreach ($commandsToExecute as $command) {
            $this->line("{$command} is being executed...");
            $this->newLine();
            $this->call("{$command}");
            $this->newLine();
            $this->line('<fg=green;options=bold>Finished</> '. $command);
            $this->newLine();
        }
    }

    /*
     * Checks if there are any pending migrations that need to be run.
     */
    private function checkPendingMigrations(): int {
        $migrator = app('migrator');

        $allFiles = $migrator->getMigrationFiles('database/migrations');
        $ran = $migrator->getRepository()->getRan();

        $pending = array_diff(array_keys($allFiles), $ran);

        return count($pending);
    }
}
