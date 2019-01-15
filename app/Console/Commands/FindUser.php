<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\User;

class FindUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'users:find {user}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Find a certain user by their first name, last name, or email';

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
     * @return mixed
     */
    public function handle()
    {
        $headers = ['ID', 'Email', 'First', 'Last'];
        $userArg = "%" . $this->argument('user') . "%";
        $user = User::where('id', 'like', $userArg)
          ->orWhere('email', 'like', $userArg)
          ->orWhere('first', 'like', $userArg)
          ->orWhere('last', 'like', $userArg)
          ->get(['id', 'email', 'first', 'last'])->toArray();
        $this->table($headers, $user);
    }
}
