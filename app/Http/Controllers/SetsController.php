<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use App\Models\Rating;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class SetsController extends Controller
{
    public function index() {
        return view('ms.pages.setting', [
            'ratings' => Rating::all(),
            'numberOfUsers' => sizeof(User::all())
        ]);
    }

    public function sendRatings()
    {
        $ratings = DB::table('ratings')->select('course_id')->distinct()->get()->toArray();
        $results = [];
        foreach($ratings as $rating) {
            $collection = DB::table('ratings')->select('review')->where('course_id', $rating->course_id)->get()->toArray();
            $text = "";
            foreach($collection as $collect) {
                $text == "" ? $text = $collect->review : $text = $text." | ".$collect->review;
            }
            $obj = array('course_id' => $rating->course_id, 'text' => $text);
            array_push($results, $obj);
        }
        $json = json_encode(array('results' => $results), JSON_PRETTY_PRINT);
        // Storage::disk('s3')->put('ratings/texts.json', $json);
    }
}
