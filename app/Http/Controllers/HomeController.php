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
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::User();
        if($user){
            $favourite = Favourite::where('user_id', $user->id)->first();
            $review = Rating::where('user_id', $user->id)->first();
            if (empty($favourite) || empty($review)) {
                $rec = DB::table('recommendations')->where('type', 'non-personalized')->orderBy('order', 'ASC')->get();
            } else {
                $rec = DB::table('recommendations')->orderBy('order', 'ASC')->get();
            }
        }else{
            $rec = DB::table('recommendations')->where('type', 'non-personalized')->orderBy('order', 'ASC')->get();
        }
        

        return view('home')->with(['rec' => $rec]);
    }

    public function generateRec()
    {
        $names = ['Most Favourite', 'People are viewing', 'People added in their lists', 'Top Category'];
        $keys = ['mFav', 'recReview', 'recFav', 'recCategory'];
        $type = ['non-personalized', 'collaborative filtering', 'collaborative filtering', 'non-personalized'];
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
