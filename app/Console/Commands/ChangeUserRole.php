<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class ChangeUserRole extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:change-user-role {email : The email of the user} {role : The new role (admin or client)}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Change the role of an existing user';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $email = $this->argument('email');
        $role = $this->argument('role');

        // Validate role
        if (!in_array($role, ['admin', 'client'])) {
            $this->error('Invalid role. Role must be either "admin" or "client".');
            return 1;
        }

        // Find user
        $user = User::where('email', $email)->first();

        if (!$user) {
            $this->error("User with email {$email} not found.");
            return 1;
        }

        // Update role
        $oldRole = $user->role;
        $user->role = $role;
        $user->save();

        $this->info("User {$user->name}'s role changed from {$oldRole} to {$role} successfully!");
        return 0;
    }
}
