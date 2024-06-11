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
    protected $signature = 'app:create-user';

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
        $user = User::factory()->create([
            'name' => 'Luk Worktree',
            'email' => 'lgastmans@worktree.in',
            'password' => Hash::make('lgast@WTree'),
        ]);

        $this->line($user.' created.');
    }
}
