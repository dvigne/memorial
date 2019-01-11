<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Photos;
use Storage;

class ShowPhotos extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'photos:show';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Show Un-owned Photos';

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
        $headers = ['Photo id', 'Photo Path', 'URL'];

        $photos = Photos::doesntHave('comment')->get(['id', 'photo_path'])->toArray();

        for ($i=0; $i < count($photos); $i++) {
          $photos[$i] = array_add($photos[$i], 'url', Storage::url($photos[$i]['photo_path']));
        }

        $this->table($headers, $photos);

        $this->info("Number of rows returned: " . count($photos));
    }
}
