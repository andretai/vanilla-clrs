<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Category;
use App\Models\Rating;
use Illuminate\Support\Facades\Auth;
use App\Models\Favourite;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\ReviewRequest;

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
        return view('course')
        ->with(['courses' => $courses]);
    }


    public function coursedetails($id)
    {
        $user = Auth::User();
        $coursedetails = Course::find($id);
        //get user rating
        if ($user) {
            $userRating = Rating::with('user')->where('user_id', $user->id)->where('course_id', $id)->first();
            //get all user rating
            $allRating = Rating::with('user')->where('course_id', $id)->whereNotIn('user_id', [$user->id])->paginate(20);
        } else {
            $userRating = [];
            $allRating = Rating::with('user')->where('course_id', $id)->paginate(20);
        }
        
        //calculate average rating
        $averageRating = Rating::where('course_id', $id)->avg('rate');
        //get number of total rating
        $totalRating = Rating::where('course_id', $id)->count();
        //count total rating
        
        return view('coursedetails')
        ->with('coursedetails', $coursedetails)
        ->with('userRating', $userRating)
        ->with('allRating', $allRating)
        ->with('averageRating', $averageRating)
        ->with('totalRating', $totalRating);
    }
    /**
     * Show the form for creating a new rating.
     *
     * @return \Illuminate\Http\Response
     */
    public function createrating(Request $request)
    {
        $user = Auth::User();
        $course = Course::where('id', $request->id)->first();
        $data = $request->validate([
            'title' => ['required','max:20','min:5'],
            'rating' => ['required'],
            'review' => ['required','max:255','min:10']
        ]);
        $rating = Rating::create(
            [
                'course_id' => $request->id,
                'platform_id' => $course->platform_id,
                'user_id' => $user->id,
                'title' => $data['title'],
                'review' => $data['review'],
                'rate' => $data['rating']
            ]
        );

        return redirect()->route('coursedetails', $course->id)->with('success', 'Thanks for the rating and review!');
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
        $data = $request->validate([
            'title' => ['required','max:20','min:5'],
            'rating' => ['required'],
            'review' => ['required','max:255','min:15']
        ]);
        $review = Rating::where('id', $request->id)->update([
            'title' => $data['title'],
            'review' => $data['review'],
            'rate' => $data['rating']
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
