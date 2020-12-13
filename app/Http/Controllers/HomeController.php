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
        $user = Auth::User();
        $courses = collect();
        $favourites = Favourite::select('course_id', DB::raw('count(*) as total'))
            ->groupBy('course_id')
            ->orderBy('total', 'DESC')
            ->take(5)
            ->get();

        $ratings = Rating::select('course_id', DB::raw('avg(rate) as avg_rating'))
            ->groupBy('course_id')
            ->orderBy('avg_rating', 'DESC')
            ->take(5)
            ->get();
        //print_r($rating);
        $ratingRec = app('App\Http\Controllers\Recommend\CollabFil')->getRecommendations($user->id, 5, 'ratings');
        //var_dump($ratingRec);
        $favRec = app('App\Http\Controllers\Recommend\CollabFil')->getRecommendations($user->id, 5, 'favourites');
        $categories = Favourite::leftJoin('courses', 'favourites.course_id', '=', 'courses.id')
            ->select('favourites.id', 'favourites.course_id', 'courses.*', DB::raw('count(courses.category_id) as total'))
            ->groupBy('courses.category_id')
            ->orderBy('total', 'DESC')
            ->take(10)
            ->get();
        //print_r($categories);
        $courses->favourites = $favourites;
        $courses->ratings = $ratings;
        $courses->categories = $categories;
        $courses->ratingRec = $ratingRec;
        $courses->favRec = $favRec;

        return view('home')->with(['courses' => $courses]);
    }

    public function generateRec()
    {
        $names = ['most favourite', 'collabfil rating', 'collabfil favourite', 'favourite category'];
        $orders = [1, 2, 3, 4];

        foreach ($names as $index => $name) {
            $rec = Recommendation::create(
                [
                    'name' => $name,
                    'order' => $orders[$index]

                ]
            );
        }
    }
}
