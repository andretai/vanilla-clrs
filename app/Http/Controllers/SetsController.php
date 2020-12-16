<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Platform;
use Illuminate\Http\Request;
use App\Models\Rating;
use App\Models\Recommendation;
use App\Models\RecommendationsRating;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use stdClass;

class SetsController extends Controller
{
    public function index() {
        // $this->sendRatings();
        // $this->createDescTags();
        // app('\App\Http\Controllers\Recommend\CalcAssoc')->getRecommendations(1, 5, 'favourites');
        // app('App\Http\Controllers\CoursesController')->getRec();
        return view('ms.pages.setting', [
            'ratings' => Rating::all(),
            'numberOfUsers' => sizeof(User::all())
        ]);
    }

    public function seed() {
        $platforms = Platform::all();
        $datasets = [];
        foreach ($platforms as $platform) {
            $fileName = 'courses_'.$platform->platform.'.json';
            $file = Storage::get($fileName);
            $decoded = json_decode($file);
            $datasets[$platform->platform] = (object) array('count'=>sizeof($decoded));
        }
        return view('ms.pages.settings.seed')
                ->with('platforms', $platforms)
                ->with('datasets', $datasets);
    }

    public function seedConfirm(Request $request) {
        return view('ms.api.seed')
                ->with('platform', $request->query('platform'))
                ->with('count', $request->query('count'));
    }

    public function recommend() {
        $recRatings = RecommendationsRating::all();
        $recs = Recommendation::all()->sortBy('order');
        $results = [];
        foreach ($recs as $rec) {
            $ratings = $recRatings->where('rec_id', $rec->id);
            $count = $ratings->count();
            $pos = $ratings->where('sentiment', 1)->count();
            $ratio = ($pos/$count) * 100;
            array_push($results, (object) array(
                'name'=>$rec->name,
                'type'=>$rec->type, 
                'count'=>$count, 
                'positive'=>$pos, 
                'ratio'=>$ratio));
        }
        return view('ms.pages.settings.recommend')
                ->with('results', $results)
                ->with('recommendations', $recs);
    }

    public function recommend_action(Request $request) {
        $action = $request->query('action');
        $rec_id = $request->query('rec_id');
        $alpha = DB::table('recommendations')->where('id', $rec_id)->first();
        switch($action) {
            case 'up': {
                $above = DB::table('recommendations')->where('order', '<', $alpha->order)->get();
                if($above) {
                    $item = $above[sizeof($above)-1];
                    DB::table('recommendations')->where('id', $item->id)->update([
                        'order' => $item->order + 1
                    ]);
                    DB::table('recommendations')->where('id', $alpha->id)->update([
                        'order' => $alpha->order - 1
                    ]);
                }
                break;
            }
            case 'down': {
                $below = DB::table('recommendations')->where('order', '>', $alpha->order)->get();
                if($below) {
                    $item = $below[0];
                    DB::table('recommendations')->where('id', $item->id)->update([
                        'order' => $item->order - 1
                    ]);
                    DB::table('recommendations')->where('id', $alpha->id)->update([
                        'order' => $alpha->order + 1
                    ]);
                }
                break;
            }
            default: {
                break;
            }
        }
        return redirect('/ms/settings/recommend');
    }

    public function sendRatings()
    {
        $ratings = DB::table('ratings')->select('course_id')->distinct()->get()->toArray();
        // $ratings = DB::table('ratings')->get()->toArray();
        $results = [];
        foreach($ratings as $rating) {
            $collection = DB::table('ratings')->select('review')->where('course_id', $rating->course_id)->get()->toArray();
            $reviewTexts = [];
            $course = DB::table('courses')->where('id', $rating->course_id)->get()->toArray();
            array_push($reviewTexts, $course[0]->title);
            array_push($reviewTexts, $course[0]->description);
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
        $file = Storage::get('keywords_weights.json');
        $decoded = json_decode($file);
        foreach ($decoded as $obj) {
            if($obj->keywords !== []) {
                $tags = new Tag();
                $tags->course_id = $obj->course_id;
                $tags->type = "descriptive";
                $tags->keywords = join(" ", $obj->keywords);
                $tags->save();
            }
        }
    }
}
