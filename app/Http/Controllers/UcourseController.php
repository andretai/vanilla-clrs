<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Category;
use App\Models\Rating;
use Illuminate\Support\Facades\Auth;
use App\Models\Favourite;
use Illuminate\Support\Facades\DB;

class UcourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $courses = Course::paginate(20);
        $categories = Category::get();
        $courses->categories = $categories;
        return view('course')->with(['courses' => $courses]);
    }

    public function search(Request $request, Course $courses)
    {
        $courses = $courses->newQuery();
        if ($request->filled('title')) {
            $courses->where('title', 'LIKE', "%{$request->get('title')}%");
        }
        if ($request->filled('category')) {
            $courses->where('category_id', $request->get('category'));
        }
        $courses = $courses->paginate(20);
        $courses->categories = Category::get();
        session()->put('forms.category', $request->get('category'));
        session()->put('forms.title', $request->get('title'));
        return view('course')->with(['courses' => $courses]);
    }


    public function coursedetails($id)
    {
        $user = Auth::User();
        $coursedetails = Course::find($id);
        //get user rating
        if ($user) {
            $userRating = Rating::with('user')->where('user_id', $user->id)->where('course_id', $id)->first();
            $coursedetails->userRating = $userRating;
            //get all user rating
            $allRating = Rating::with('user')->where('course_id', $id)->whereNotIn('user_id', [$user->id])->paginate(20);
            $coursedetails->allrating = $allRating;
        }else{
            $allRating = Rating::with('user')->where('course_id', $id)->paginate(20);
            $coursedetails->allrating = $allRating;
        }


        //calculate average rating
        $averageRating = Rating::where('course_id', $id)->avg('rate');
        $coursedetails->averageRating = $averageRating;
        //get number of total rating
        $coursedetails->totalRating = Rating::where('course_id', $id)->count();

        return view('coursedetails')->with(['coursedetails' => $coursedetails]);
    }
    /**
     * Show the form for creating a new rating.
     *
     * @return \Illuminate\Http\Response
     */
    public function rating(Request $request)
    {
        if ($request->rating) {
            $user = Auth::User();
            $course = Course::where('id', $request->id)->first();
            $rating = Rating::create(
                [
                    'course_id' => $request->id,
                    'platform_id' => 1,
                    'user_id' => $user->id,
                    'title' => $request->title,
                    'review' => $request->review,
                    'rate' => $request->rating
                ]
            );
            //return Rating::all();
            return redirect()->back()->with('success', 'Thanks for the rating and review!');
        }
    }

    public function removerating(Request $request)
    {
        if ($request->id) {
            $remove = Rating::where('id', $request->id)->delete();
            return redirect()->back()->with('alert', 'Review has been removed!');
        }
    }

    public function editrating(Request $request)
    {
        $review = Rating::where('id', $request->id)->first();
        return view('editrating')->with(['review' => $review]);
    }

    public function updaterating(Request $request)
    {
        $course = Rating::where('id', $request->id)->first();
        $review = Rating::where('id', $request->id)->update([
            'title' => $request->title,
            'review' => $request->review,
            'rate' => $request->rating
        ]);
        return redirect()->route('coursedetails', $course->course_id)->with('update', 'Review has been updated!');
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
