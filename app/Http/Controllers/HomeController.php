<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Course;
use App\Models\Favourite;
use App\Models\Rating;
use App\Models\Recommendation;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // $user = Auth::User();
        // $courses = collect();
        // $mfavourite = Favourite::leftJoin('courses', 'favourites.course_id', '=', 'courses.id')
        //     ->select('course_id', DB::raw('count(*) as total'))
        //     ->groupBy('course_id')
        //     ->orderBy('total', 'DESC')
        //     ->take(5)
        //     ->get();

        // //print_r($rating);
        // $ratingRec = app('App\Http\Controllers\Recommend\CollabFil')->getRecommendations($user->id, 5, 'ratings');
        // //var_dump($ratingRec);
        // $favRec = app('App\Http\Controllers\Recommend\CollabFil')->getRecommendations($user->id, 5, 'favourites');
        // $tcategory = Favourite::leftJoin('courses', 'favourites.course_id', '=', 'courses.id')
        //     ->select('favourites.id', 'favourites.course_id', 'courses.*', DB::raw('count(courses.category_id) as total'))
        //     ->groupBy('courses.category_id')
        //     ->orderBy('total', 'DESC')
        //     ->take(10)
        //     ->get();
        // //print_r($categories);
        // $courses->mfavourite = $mfavourite;
        // $courses->ratingRec = $ratingRec;
        // $courses->favRec = $favRec;
        // $courses->tcategory = $tcategory;
        $rec = DB::table('recommendations')->orderBy('order','ASC')->get();
        return view('home')->with(['rec' => $rec]);
    }

    public function generateRec()
    {
        $names = ['Most Favourite', 'People are viewing', 'People added in their lists', 'Top Category'];
        $keys = ['mFav', 'recReview', 'recFav', 'recCategory'];
        $type = ['non-personalized', 'collaborative filtering','collaborative filtering','non-personalized' ];
        $orders = [1, 2, 3, 4];

        foreach ($names as $index => $name) {
            $rec = Recommendation::create(
                [
                    'name' => $name,
                    'key' => $keys[$index],
                    'order' => $orders[$index],
                    'type' => $type[$index]

                ]
            );
        }
    }
}
