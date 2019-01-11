<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Photos;

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
        $headers = ['Photo id', 'Photo Path'];

        $photos = Photos::doesntHave('comment')->get(['id', 'photo_path'])->toArray();

        $this->table($headers, $photos);

        $this->info("Number of rows returned: " . count($photos));
    }
}
