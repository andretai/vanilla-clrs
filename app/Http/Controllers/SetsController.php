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
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use stdClass;

class SetsController extends Controller
{
    public function index() {
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

    public function recommend(Request $request) {
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
        if($request->query('status') !== null){
            return view('ms.pages.settings.recommend')
                ->with('results', $results)
                ->with('recommendations', $recs)
                ->with('status', $request->query('status'));
        }
        return view('ms.pages.settings.recommend')
                ->with('results', $results)
                ->with('recommendations', $recs);
    }

    public function recommend_action(Request $request) {
        $status = true;
        try {
            $action = $request->query('action');
            $rec_id = $request->query('rec_id');
            $alpha = DB::table('recommendations')->where('id', $rec_id)->first();
            switch($action) {
                case 'up': {
                    $above = DB::table('recommendations')->where('order', '<', $alpha->order)->get();
                    if($above) {
                        $item = $above[sizeof($above)-1];
                        DB::table('recommendations')->where('key', $item->key)->update([
                            'order' => $item->order + 1
                        ]);
                        DB::table('recommendations')->where('key', $alpha->key)->update([
                            'order' => $alpha->order - 1
                        ]);
                    }
                    break;
                }
                case 'down': {
                    $below = DB::table('recommendations')->where('order', '>', $alpha->order)->get();
                    if($below) {
                        $item = $below[0];
                        DB::table('recommendations')->where('key', $item->key)->update([
                            'order' => $item->order - 1
                        ]);
                        DB::table('recommendations')->where('key', $alpha->key)->update([
                            'order' => $alpha->order + 1
                        ]);
                    }
                    break;
                }
                default: {
                    break;
                }
            }
        } catch(Exception $e) {
            $status = false;
        }
        return redirect(route('ms-sets-recommend', ['status' => $status]));
    }

    public function collectTexts()
    {
        $courses = Course::all();
        $results = [];
        foreach ($courses as $course) {
            $texts = [];
            array_push($texts, $course->title);
            array_push($texts, $course->description);
            $ratings = DB::table('ratings')->where('course_id', $course->id)->get()->toArray();
            if(sizeof($ratings) > 0) {
                foreach ($ratings as $rating) {
                    array_push($texts, $rating->title);
                    array_push($texts, $rating->review);
                }
            }
            $obj = array('course_id' => $course->id, 'reviewTexts' => $texts);
            array_push($results, $obj);
        }
        usort($results, function ($a, $b) {
            return $a['course_id'] - $b['course_id'];
        });
        $json = json_encode(array('results' => $results), JSON_PRETTY_PRINT);
        Storage::put('texts.json', $json);
    }

    public function createTags() {
        $file = Storage::get('keywords_weights.json');
        $decoded = json_decode($file);
        DB::table('tags')->truncate();
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
