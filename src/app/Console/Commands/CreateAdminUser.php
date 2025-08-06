<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class CreateAdminUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:admin {email=admin@portfolio.local} {password=password123}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create or update admin user';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $email = $this->argument('email');
        $password = $this->argument('password');

        // Delete existing user if exists
        User::where('email', $email)->delete();

        // Create new user
        $user = User::create([
            'name' => 'Administrador',
            'email' => $email,
            'password' => Hash::make($password),
            'email_verified_at' => now(),
        ]);

        $this->info("Admin user created successfully!");
        $this->info("Email: {$email}");
        $this->info("Password: {$password}");
        
        // Test password
        $passwordTest = Hash::check($password, $user->password);
        $this->info("Password test: " . ($passwordTest ? 'VALID' : 'INVALID'));

        return 0;
    }
}
