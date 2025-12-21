<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class PromoteToAdmin extends Command
{
    protected $signature = 'user:promote {email}';
    protected $description = 'Promote a user to admin role';

    public function handle()
    {
        $email = $this->argument('email');
        $user = User::where('email', $email)->first();

        if (!$user) {
            $this->error("User with email {$email} not found!");
            return;
        }

        $user->update(['role' => 'admin']);
        $this->info("✓ User {$user->name} ({$email}) has been promoted to admin!");
    }
}
