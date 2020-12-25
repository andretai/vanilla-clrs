<?php

namespace App\Console\Commands;

use App\Models\Platform;
use Illuminate\Console\Command;

class platforms extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'default:platforms';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Automatically created default platforms.';

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
        $platforms = [
            array('platform' => 'udemy', 'image' => 'udemy.png'),
            array('platform' => 'futurelearn', 'image' => 'futurelearn.jpg')
        ];
        for ($i=0; $i < sizeof($platforms) ; $i++) { 
            $platform = new Platform();
            $platform->platform = $platforms[$i]['platform'];
            $platform->image = $platforms[$i]['image'];
            $platform->save();
        }
        $this->info('Default platforms have been created.');
    }
}
