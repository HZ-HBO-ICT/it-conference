<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use function Laravel\Prompts\progress;
use function Laravel\Prompts\text;
use function Laravel\Prompts\password;

class CreateAdmin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'admin:create-admin-user';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new admin user';

    /**
     * Execute the console command.
     *
     */
    public function handle(): void
    {
        $name = text(
            'Please input the name of the admin user',
            'E.g. John Smith',
            '',
            true,
            validate: ['name' => 'required|string|max:255']
        );

        $email = text(
            'Please input the email of the admin user',
            'E.g. user@example.com',
            '',
            true,
            validate: ['email' => 'required|string|email:rfc,dns|max:255|unique:users']
        );

        $password = password(
            'Please input the password for the admin user',
            '',
            true
        );

        progress(
            'Creating admin user',
            ['creating admin user'],
            function () use ($name, $email, $password) {
                $this->createUser($name, $email, $password);
            }
        );
    }

    /**
     * Create the user and assign admin rights
     *
     * @param $email string
     * @param $name string
     * @param $password string
     */
    private function createUser(string $name, string $email, string $password): void
    {
        $user = User::create([
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($password)
        ]);
        // Do stuff here to make the user an admin user
        $user->markEmailAsVerified();
        $user->assignRole('event organizer');

        // Finish off
        $user->save();
        $this->info("Admin user $user->name is created");
    }
}
