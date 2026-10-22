<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class CreateSuperAdmin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:create-super-admin {--email=admin@example.com} {--name=Super Admin} {--password=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a super admin user';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $email = $this->option('email');
        $name = $this->option('name');
        $password = $this->option('password');

        // Check if user already exists
        if (User::where('email', $email)->exists()) {
            $this->error("User with email {$email} already exists!");
            return 1;
        }

        // If password not provided, prompt for it
        if (!$password) {
            $password = $this->secret('Enter password (min 8 characters):');
            $passwordConfirmation = $this->secret('Confirm password:');
            
            if ($password !== $passwordConfirmation) {
                $this->error('Passwords do not match!');
                return 1;
            }
            
            if (strlen($password) < 8) {
                $this->error('Password must be at least 8 characters!');
                return 1;
            }
        }

        // Create super admin user
        $user = User::create([
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($password),
            'role' => 'super_admin',
        ]);

        $this->info("Super Admin user created successfully!");
        $this->info("Email: {$user->email}");
        $this->info("Name: {$user->name}");
        $this->info("Role: {$user->role}");

        return 0;
    }
}
