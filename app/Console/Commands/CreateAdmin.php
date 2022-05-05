<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class CreateAdmin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:admin {--e|email= : New Admin Email} {--p|password= : New Admin Password}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command creates a new administrator in the database';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        if ($this->confirm('Are you sure that you want to create a new admin?', true)) {
            $email = $this->option("email");
            $password = $this->option("password");
            $this->info('A new admin has been created successfully!');
            User::create([
                'name' => 'admin',
                'email' => $email,
                'password' => Hash::make($password),
                'role_id' => 1
            ]);
        }
    }
}
