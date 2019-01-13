<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Photos;
use Storage;

class DeletePhotos extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'photos:delete';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete un-owned photos from storage and model';

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
        $photos = Photos::doesntHave('comment')->get(['id', 'photo_path']);
        foreach($photos as $photo) {
          $this->info("Deleting Photo " . $photo->id);
          Storage::delete($photo->photo_path);
          $photo->delete();
        }
        $this->info("Done");
    }
}
