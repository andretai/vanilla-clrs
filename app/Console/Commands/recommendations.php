<?php

namespace App\Console\Commands;

use App\Models\Recommendation;
use Illuminate\Console\Command;

class recommendations extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'default:recommendations';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Automaticall create default recommendations.';

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
        $recommendations = [
            array('name' => 'Most Favourite', 'key' => 'mFav', 'order' => 1, 'type' => 'non-personalized'),
            array('name' => 'People are viewing', 'key' => 'recReview', 'order' => 2, 'type' => 'collaborative filtering'),
            array('name' => 'People added in lists', 'key' => 'recFav', 'order' => 3, 'type' => 'collaborative filtering'),
            array('name' => 'Top Category', 'key' => 'recCategory', 'order' => 4, 'type' => 'non-personalized')
        ];
        for ($i=0; $i < sizeof($recommendations) ; $i++) { 
            $rec = new Recommendation();
            $rec->id = $i+1;
            $rec->name = $recommendations[$i]['name'];
            $rec->key = $recommendations[$i]['key'];
            $rec->order = $recommendations[$i]['order'];
            $rec->type = $recommendations[$i]['type'];
            $rec->save();
        }
        $this->info('Default recommendations have been created.');
    }
}
