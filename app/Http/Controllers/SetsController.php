<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use App\Models\Rating;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class SetsController extends Controller
{
    public function index() {
        // $this->sendRatings();
        // $this->createDescTags();
        // app('\App\Http\Controllers\Recommend\CalcAssoc')->getRecommendations(1, 5, 'favourites');
        return view('ms.pages.setting', [
            'ratings' => Rating::all(),
            'numberOfUsers' => sizeof(User::all())
        ]);
    }

    public function sendRatings()
    {
        $ratings = DB::table('ratings')->select('course_id')->distinct()->get()->toArray();
        // $ratings = DB::table('ratings')->get()->toArray();
        $results = [];
        foreach($ratings as $rating) {
            $collection = DB::table('ratings')->select('review')->where('course_id', $rating->course_id)->get()->toArray();
            $reviewTexts = [];
            foreach($collection as $collect) {
                array_push($reviewTexts, $collect->review);
            }
            $obj = array('course_id' => $rating->course_id, 'reviewTexts' => $reviewTexts);
            // $obj = array('title' =>  $rating->title, 'review' => $rating->review);
            array_push($results, $obj);
        }
        usort($results, function ($a, $b) {
            return $a['course_id'] - $b['course_id'];
        });
        $json = json_encode(array('results' => $results), JSON_PRETTY_PRINT);
        // Storage::disk('s3')->put('ratings/texts.json', $json);
        Storage::put('texts.json', $json);
        // dd($ratings);
    }

    public function createDescTags() {
        $file = Storage::get('keywords_weights_nn.json');
        $decoded = json_decode($file);
        foreach ($decoded as $obj) {
            $tags = new Tag();
            $tags->course_id = $obj->course_id;
            $tags->type = "descriptive";
            $tags->keywords = join(" ", $obj->keywords);
            $tags->save();
        }
    }
}
