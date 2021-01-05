<?php

namespace App\Console\Commands;

use App\Models\Mission;
use Illuminate\Console\Command;

class missions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'default:missions';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        $missions = [
            array('title' => 'Comment one Udemy course', 'reward' => '15', 'type'=> 'comment','volume'=> '1', 'platform_id' => 1),
            array('title' => 'Comment one FutureLearn course', 'reward' => '15', 'type'=> 'comment','volume'=> '1', 'platform_id' => 2),
            array('title' => 'Add 3 Udemy course in favourite list', 'reward' => '10', 'type'=> 'favourite','volume'=> '3', 'platform_id' => 1),
            array('title' => 'Add 3 FutureLearn course in favourite list', 'reward' => '10', 'type'=> 'favourite','volume'=> '3', 'platform_id' => 2)
        ];
        for ($i = 0; $i < sizeof($missions); $i++) {
            $mission = new Mission();
            $mission->id = $i + 1;
            $mission->title = $missions[$i]['title'];
            $mission->reward = $missions[$i]['reward'];
            $mission->type = $missions[$i]['type'];
            $mission->volume = $missions[$i]['volume'];
            $mission->platform_id = $missions[$i]['platform_id'];
            $mission->save();
        }
        $this->info('Default mission have been created.');
    }
}
