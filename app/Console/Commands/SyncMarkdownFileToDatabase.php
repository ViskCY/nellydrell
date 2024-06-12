<?php

namespace App\Console\Commands;

use App\Http\Controllers\MarkdownFileParser;
use Illuminate\Console\Command;

class SyncMarkdownFileToDatabase extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'markdown:sync {filename? : Määrake sünkroonitav fail, vastasel juhul sünkroonitakse kõik failid.}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sünkrooni markdown failid andmebaasiga.';

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
        return $this->info(
            MarkdownFileParser::sync($this->argument('filename'))
        );
    }
}
