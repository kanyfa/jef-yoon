<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Moussa Diop',
            'email' => 'candidate@jejyoon.sn',
            'role' => 'candidate',
            'email_verified_at' => now(),
            'password' => bcrypt('password'),
        ]);

        User::create([
            'name' => 'Aminata Ndiaye',
            'email' => 'company@jejyoon.sn',
            'role' => 'company',
            'email_verified_at' => now(),
            'password' => bcrypt('password'),
        ]);
    }
}
