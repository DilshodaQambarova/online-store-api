<?php

namespace Database\Seeders;

use App\Jobs\SendEmailJob;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->count(10)->create();

        $user = User::create([
            'role_id' => 1,
            'first_name' => 'Admin',
            'last_name' => 'Admin',
            'email' => 'qambarovadilshoda867@gmail.com',
            'verification_token' => uniqid(),
            'phone' => preg_replace('/[^0-9+]/', '', fake()->phoneNumber()),
            'password' => bcrypt('admin123'),
            'email_verified_at' => now()
        ]);
        SendEmailJob::dispatch($user);
    }
}
