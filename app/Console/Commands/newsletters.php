<?php

namespace App\Console\Commands;

use App\Models\Newsletter;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class newsletters extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'default:newsletters';

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
        $fl_file = Storage::get('fl_newsletter.json');
        $udemy_file = Storage::get('udemy_newsletter.json');
        $fl_newsletter = json_decode($fl_file, true);
        $udemy_newsletter = json_decode($udemy_file, true);

        foreach ($fl_newsletter as $fl) {
            $temp = $fl['date'];
            $date = date_create($fl['date']);
            $fl['date'] = date_format($date, "Y-m-d");
            $storeDB = Newsletter::create(
                [
                    'title' => $fl['title'],
                    'description' =>$fl['description'],
                    'url' =>$fl['url-href'],
                    'platform' => 'futurelearn',
                    'date' => $fl['date']
                ]
            );
        }

        foreach ($udemy_newsletter as $udemy) {
            $temp = $udemy['title'];
            $split = explode(" ", $temp);
            $date = date_create('1 ' . $split[0] . ' ' . $split[1]);
            $udemy['date'] = date_format($date, "Y-m-d");
            $storeDB = Newsletter::create(
                [
                    'title' => $udemy['title'],
                    'description' =>$udemy['description'],
                    'url' =>$udemy['url-href'],
                    'platform' => 'udemy',
                    'date' => $udemy['date']
                ]
            );
        }

        $this->info('Newsletters have been created.');
    }
}
