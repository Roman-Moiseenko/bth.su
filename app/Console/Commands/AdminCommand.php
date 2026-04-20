<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class AdminCommand extends Command
{
    protected $signature = 'admin:new';

    protected $description = 'Создать админа admin с логином admin и паролем 12345678';

    public function handle(): bool
    {
        $user = User::register('admin', 'admin', 12345678)->first();
        if (!is_null($user)) $this->info('Создан');
        return true;
    }
}
