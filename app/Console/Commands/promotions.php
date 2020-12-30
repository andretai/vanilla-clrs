<?php

namespace App\Console\Commands;
use App\Models\Promotion;
use Illuminate\Console\Command;

class promotions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'default:promotions';

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
        $promotion = [
            array(
                'platform' => 'udemy',
                'description' => 'Get 10% Discount For Best Udemy Courses With Coupon Codes That Guarantee Great Savings Up To 50USD.',
                'image' => '/images/udemy.png',
                'code' => 'UDEMYCLRS10',
                'url' => 'https://www.udemy.com/'
            ),
            array(
                'platform' => 'futurelearn',
                'description' => 'Get 10% Discount For Best Futurelearn Courses With Coupon Codes That Guarantee Great Savings Up To 50USD.',
                'image' => '/images/futurelearn.jpg',
                'code' => 'FLCLRS10',
                'url' => 'https://www.futurelearn.com/'
            ),

        ];
        for ($i = 0; $i < sizeof($promotion); $i++) {
            $rec = new Promotion();
            $rec->id = $i + 1;
            $rec->platform = $promotion[$i]['platform'];
            $rec->description = $promotion[$i]['description'];
            $rec->image = $promotion[$i]['image'];
            $rec->code = $promotion[$i]['code'];
            $rec->url = $promotion[$i]['url'];

            $rec->save();
        }
        $this->info('Default promotion have been created.');
    }
}
