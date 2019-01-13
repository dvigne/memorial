<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\User;

class ListUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'users:list';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Show all active users';

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
        $headers = ['ID', 'First', 'Last', 'Email', 'Date Registered'];

        $users = User::all(['id', 'first', 'last', 'email', 'created_at'])->toArray();

        $this->table($headers, $users);
        $this->info("Total Number of Users: " . count($users));
    }
}
