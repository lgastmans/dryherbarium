<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class CreateUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:create-user {username} {useremail}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Manually create a user';

    /**
     * Execute the console command.
     */
    public function handle()
    {

        $userName = $this->argument('username');
        $userEmail = $this->argument('useremail');

        $user = User::factory()->create([
            'name' => $userName,
            'email' => $userEmail,
            'password' => Hash::make($userName.'@avbgHerb'),
        ]);

        $this->line($userName.' created.');
    }
}
