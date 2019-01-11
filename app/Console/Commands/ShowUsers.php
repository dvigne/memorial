<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Photos;
use App\User;

class ShowUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'photos:users';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Show Photo Owners';

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
      $headers = ['Photo id', 'First', 'Last', 'Email'];

      $photos = Photos::doesntHave('comment')->get(['id', 'user_id'])->toArray();

      for ($i=0; $i < count($photos); $i++) {
        $user = User::findOrFail($photos[$i]['user_id']);
        array_forget($photos[$i], 'user_id');
        $photos[$i] = array_add($photos[$i], 'Name', $user->first);
        $photos[$i] = array_add($photos[$i], 'Last', $user->last);
        $photos[$i] = array_add($photos[$i], 'Email', $user->email);
      }

      $this->table($headers, $photos);

      $this->info("Number of rows returned: " . count($photos));
    }
}
