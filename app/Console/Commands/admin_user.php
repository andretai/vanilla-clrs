<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class admin_user extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:admin_user';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creates an administrative account.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $user = new User();
        $user->name = 'admin';
        $user->is_admin = true;
        $user->email = 'admin@email.com';
        $user->password = bcrypt('admin');
        $user->save();

        if($user) {
            $this->info('Administrative account has been created.');
        }
    }
}
