<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class AdminCreateCommand extends Command
{
    protected $signature = 'admin:create
                            {name : Имя пользователя}
                            {email : Почта/логин}
                            {password : Пароль }';

    protected $description = 'Создать админа {name} с логином {email} и паролем {password}';

    public function handle(): bool
    {
        $name = $this->argument('name');
        $password = $this->argument('password');
        $email = $this->argument('email');
        $user = User::register($name, $email, $password)->first();
        return true;
    }
}
