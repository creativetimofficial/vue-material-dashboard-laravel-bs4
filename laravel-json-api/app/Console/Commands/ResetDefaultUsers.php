<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class ResetDefaultUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:reset-default-users';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Resets the default users values';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        if (env('IS_DEMO')) {
            $user = User::find('1');
            if ($user) {
                $user->update(['name' => 'Admin', 'email' => 'admin@jsonapi.com', 'password' => 'secret']);
                $users = User::where('id', '!=', '1');
                $users->delete();
            }
        }
    }
}
