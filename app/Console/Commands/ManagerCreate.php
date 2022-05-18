<?php

namespace App\Console\Commands;

use App\Models\FormRequest;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Session\Store;

class ManagerCreate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'manager:create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creates new user with manager role';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $user = User::query()->make([
            'name' => $this->ask('Name: '),
            'email' => $this->ask('Email: '),
            'role_id' => config('auth.user_roles.manager'),
        ]);

        $password = $this->secret('Password: ');
        $passwordConfirm = $this->secret('Password confirm: ');

        if ($password !== $passwordConfirm) {
            $this->alert('Password mismatch, users didn`t created');
            return false;
        }
        $user->password = bcrypt($password);

        return $user->save();
    }
}
