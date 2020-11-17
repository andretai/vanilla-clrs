<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Favourite;
use App\Models\Course;

class UfavouriteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::User();
        $favourites = Favourite::with('course')->where('user_id', $user->id)->get();
        $getFirstFavCourse = Favourite::with('course')->where('user_id', $user->id)->first();
        $result = app('App\Http\Controllers\Recommend\CalcAssoc')->getRecommendations($getFirstFavCourse->course_id, 4, 'favourites');
        //var_dump($result);
        $recommendCourse = array();
        foreach ($result as $r) {
            $temp = Course::where('title',$r)->first();
            array_push($recommendCourse,$temp);
        }
        $favourites->recommendCourse = $recommendCourse;
        return view('favourite')->with(['favourites' => $favourites]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function addtofav($id)
    {
        $course = Course::find($id);
        if (!$course) {
            abort(404);
        }

        $user = Auth::User();

        $favourite = Favourite::where('user_id', $user->id)->where('course_id', $id)->first();
        //if favourite is empty then this is the first favourite
        if (!$favourite) {
            $newFavourite = Favourite::create(
                ['user_id' => $user->id, 'course_id' => $id]
            );
            return redirect()->back()->with('success', 'Course added as favourite successfully!');
        } else {
            return redirect()->back()->with('exist', 'Course already added as favourite!');
        }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function removefav(Request $request)
    {
        $user = Auth::User();
        if($request->id){
            //$course = Favourite::where('id',$request->id)->first();
            $remove = Favourite::where('id',$request->id)->delete();
            return redirect()->back()->with('alert','A course has been removed!');
        }
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }
}
