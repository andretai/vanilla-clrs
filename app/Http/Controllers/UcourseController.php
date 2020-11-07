<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Rating;
use Illuminate\Support\Facades\Auth;
class UcourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $courses = Course::paginate(21);
        return view('course')->with(['courses'=>$courses]);
    }

    public function coursedetails($id)
    {
        $user = Auth::User();
        $coursedetails = Course::find($id);
        //get user rating
        $userRating = Rating::with('user')->where('user_id', $user->id)->where('course_id',$id)->first();
        $coursedetails->userRating = $userRating;
        //get all user rating
        $allRating = Rating::with('user')->where('course_id',$id)->whereNotIn('user_id',[$user->id])->get();
        $coursedetails->allrating = $allRating;
        //calculate average rating
        $averageRating = Rating::where('course_id',$id)->avg('rate');
        $coursedetails->averageRating = $averageRating;
        //get number of total rating
        $coursedetails->totalRating = Rating::where('course_id',$id)->count();
        //return $coursedetails;
        return view('coursedetails')->with(['coursedetails'=>$coursedetails]);
    }
    /**
     * Show the form for creating a new rating.
     *
     * @return \Illuminate\Http\Response
     */
    public function rating(Request $request)
    {
        if($request->rating){
            $user = Auth::User();
            $course = Course::where('id',$request->id)->first();
            $rating = Rating::insert(
                ['course_id'=> $request->id, 
                'platform_id' => 1, 
                'user_id' => $user->id, 
                'title'=> $course->title,
                'review' => $request->review,
                'rate' => $request->rating]
            );
            //return Rating::all();
            return redirect()->back()->with('success', 'Thanks for the rating and review!');
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
