<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;

class CreateUserCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:create {--admin}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creates a new user, with optional admin privileges';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $name = $this->ask('Full Name');
        $email = $this->ask('Email Address');
        $password = $this->secret('Password');

        $validator = Validator::make([
            'name' => $name,
            'email' => $email,
            'password' => $password,
        ], [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', Password::min(8)->numbers()],
        ]);

        if ($validator->fails()) {
            $this->info('User not created. See error messages below:');
            foreach ($validator->errors()->all() as $error) {
                $this->error($error);
            }

            return 1;
        }

        $isAdmin = $this->option('admin');

        User::create([
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($password),
            'is_admin' => $isAdmin,
        ]);

        if ($isAdmin) {
            $this->info('✅ Admin user created successfully!');
        } else {
            $this->info('✅ User created successfully!');
        }

        return 0;
    }
}
