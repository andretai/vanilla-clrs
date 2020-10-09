<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\DB;
use Livewire\Component;

class AssociateCourses extends Component
{
    public $alphaCourse = 1;

    public function render()
    {
        $courses = $this->getRatedCourses();
        return view('livewire.ms.associate-courses', [
            'courses' => $courses,
            'selectedCourse' => $this->getRatedCourses()[$this->alphaCourse],
            // 'updatedCourses' => $this->separateAlphaCourse(),
            'userratings' => sizeof($this->getAlphaCourseUserIds()),
            'alsorated' => array_values(array_unique($this->getAlsoRated())),
            'assoc' => $this->calcAssoc()
        ]);
        // $this->calcAssoc();
        // return dd($this->otherCourseUserIds());
    }

    public function getRatings() {
        $ratingsByCourse = DB::table('ratings')->select('course_id')->distinct()->get()->toArray();
        return $ratingsByCourse;
    }

    public function getRatedCourses() {
        $ratedCourses = [];
        $ratings = $this->getRatings();
        foreach($ratings as $rating) {
            $ratedCourse = DB::table('courses')->where('id', $rating->course_id)->first();
            array_push($ratedCourses, $ratedCourse);
        }
        return $ratedCourses;
    }

    // public function separateAlphaCourse() {
    //     $courses = $this->getRatedCourses();
    //     $selectedCourse = $courses[$this->alphaCourse];
    //     $key = array_search($selectedCourse, $courses);
    //     array_splice($courses, $key, 1);
    //     return $courses;
    // }

    public function getAlphaCourseUserIds() {
        $alphaCourse = $this->getRatedCourses()[$this->alphaCourse]->id;
        $alphaCourseRatings = DB::table('ratings')->where('course_id', $alphaCourse)->get()->toArray();
        $alphaCourseUserIds = [];
        foreach($alphaCourseRatings as $alphaCourseRating) {
            array_push($alphaCourseUserIds, $alphaCourseRating->user_id);
        }
        return $alphaCourseUserIds;
    }

    public function otherCourseUserIds() {
        $alphaCourseUserIds = $this->getAlphaCourseUserIds();
        $nonAlphaRatings = $this->getNonAlphaCourses();
        $result = [];
        foreach($alphaCourseUserIds as $userId) {
            foreach($nonAlphaRatings as $rating) {
                if($rating->user_id === $userId) {
                    array_push($result, $rating->course_id);
                }
            }
        }
        return $result;
    }

    public function getAlsoRated() {
        $courseIds = $this->otherCourseUserIds();
        $courseTitles = [];
        foreach($courseIds as $courseId) {
            $courseTitle = DB::table('courses')->where('id', $courseId)->first();
            array_push($courseTitles, $courseTitle->title);
        }
        return $courseTitles;
    }

    public function calcAssoc() {
        $arr = $this->getAlsoRated();
        $unique_arr = array_unique($arr);
        $alphaScores = sizeof($this->getAlphaCourseUserIds());
        $otherScores = [];
        foreach($unique_arr as $eachitem) {
            $count = 0;
            foreach($arr as $item) {
                if($item === $eachitem) {
                    $count++;
                }
            }
            array_push($otherScores, $count);
        }
        $result = [];
        foreach($otherScores as $otherscore) {
            $assoc = ($alphaScores + $otherscore) / $alphaScores;
            array_push($result, $assoc);
        }
        return $result;
    }

    public function getNonAlphaCourses() {
        $alphaCourseId = $this->getRatedCourses()[$this->alphaCourse]->id;
        $nonAlphaRatings = DB::table('ratings')
                        ->where('course_id', '!=', $alphaCourseId)
                        ->get();
        return $nonAlphaRatings;
    }
}
