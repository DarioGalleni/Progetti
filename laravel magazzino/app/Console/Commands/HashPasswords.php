<?php

namespace App\Console\Commands;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Console\Command;

class HashPasswords extends Command
{
    protected $signature = 'app:hash-passwords';
    protected $description = 'Hash all plain text passwords in the database.';

    public function handle()
    {
        $users = User::all();
        foreach ($users as $user) {
            if (!Hash::info($user->password)['algo']) {
                $user->password = Hash::make($user->password);
                $user->save();
                $this->info("Password for user '{$user->username}' has been hashed.");
            } else {
                $this->info("Password for user '{$user->username}' is already hashed.");
            }
        }
        $this->info('All passwords processed.');
    }
}
