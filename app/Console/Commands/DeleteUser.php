<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\User;
use Storage;

class DeleteUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'users:delete {userid}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete user matching id';

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
      if($user = User::find($this->argument('userid'))) {
        if($this->confirm("Are you sure you want to delete user " . $user->first . " " . $user->last . "(" . $user->email . ")")) {
          foreach($user->photos()->get() as $photo) {
            $this->info("Deleting photo " . $photo->id);
            Storage::delete($photo->photo_path);
            $photo->delete();
          }
          foreach($user->comments()->get() as $comment) {
            $this->info("Deleting comment " . $comment->id);
            $comment->delete();
          }
          $user->delete();
        }
      }
      else {
        $this->error("Error, failed to load user from model. Please check syntax and try again");
      }
    }
}
