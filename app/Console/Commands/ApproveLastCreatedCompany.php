<?php

namespace App\Console\Commands;

use App\Models\Company;
use Illuminate\Console\Command;

// Created for easier manual testing
// TODO: Delete once the app is ready for deploy
class ApproveLastCreatedCompany extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:approve-last-created-company';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $company = Company::latest()->first();
        $company->update(['is_approved' => 1]);
    }
}
