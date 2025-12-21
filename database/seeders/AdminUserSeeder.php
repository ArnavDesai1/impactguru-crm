<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        // Disabled - Users are auto-assigned roles on registration
        // First registered user = Admin, subsequent users = Staff
    }
}

