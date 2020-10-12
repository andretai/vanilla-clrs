<?php

namespace App\Http\Controllers\Recommend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class AssocAlsoRated extends Controller
{

    public function getRecommendations($alphaCourse, $resultCount) {
        return $this->calcAssoc($alphaCourse, $resultCount);
    }

    /**
     * return rated courses' course ids
     * @return all distinct course_id from ratings table 
     */
    public function getRatings() {
        $ratingsByCourse = DB::table('ratings')->select('course_id')->distinct()->get()->toArray();
        return $ratingsByCourse;
    }

    /**
     * call $this->getRatings()
     * return rated courses
     * @return all rated courses from courses table
     */
    public function getRatedCourses() {
        $ratedCourses = [];
        $ratings = $this->getRatings();
        foreach($ratings as $rating) {
            $ratedCourse = DB::table('courses')->where('id', $rating->course_id)->first();
            array_push($ratedCourses, $ratedCourse);
        }
        return $ratedCourses;
    }
    
    /**
     * call $this->getRatedCourses()
     * return users' user ids who have rated the alpha course
     * @return all alpha course user_id from ratings table
     */
    public function getAlphaCourseUserIds($alphaCourse) {
        $alphaCourseId = $this->getRatedCourses()[$alphaCourse]->id;
        $alphaCourseRatings = DB::table('ratings')->where('course_id', $alphaCourseId)->get()->toArray();
        $alphaCourseUserIds = [];
        foreach($alphaCourseRatings as $alphaCourseRating) {
            array_push($alphaCourseUserIds, $alphaCourseRating->user_id);
        }
        return $alphaCourseUserIds;
    }

    /**
     * call $this->getRatedCourses()
     * return ratings that does not belong to the alpha course
     * @return all non-alpha rated courses' ratings from ratings table
     */
    public function getNonAlphaCourses($alphaCourse) {
        $alphaCourseId = $this->getRatedCourses()[$alphaCourse]->id;
        $nonAlphaRatings = DB::table('ratings')
                        ->where('course_id', '!=', $alphaCourseId)
                        ->get();
        return $nonAlphaRatings;
    }

    /**
     * call $this->getAlphaCourseUserIds(), $this->getNonAlphaCourses()
     * return other courses' course ids that were rated by users who have rated the alpha course
     * @return all non-alpha course_id by alpha course user_id
     */
    public function otherCourseUserIds($alphaCourse) {
        $alphaCourseUserIds = $this->getAlphaCourseUserIds($alphaCourse);
        $nonAlphaRatings = $this->getNonAlphaCourses($alphaCourse);
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

    public function getAlsoRated($alphaCourse) {
        $courseIds = $this->otherCourseUserIds($alphaCourse);
        $courseTitles = [];
        foreach($courseIds as $courseId) {
            $courseTitle = DB::table('courses')->where('id', $courseId)->first();
            array_push($courseTitles, $courseTitle->title);
        }
        return $courseTitles;
    }

    public function calcAssoc($alphaCourse, $resultCount) {
        # How to Calculate Association
        # Assoc = (Y + X) / Y
        # where 
        #       Y = user count of users who've rated alpha course,
        #       X = user count of users who've rated alpha course and a specific non-alpha course

        # Get all non-alpha courses rated by alpha course user
        $arr = $this->getAlsoRated($alphaCourse);
        # Get distinct non-alpha courses rated by alpha course user
        $unique_arr = array_values(array_unique($arr));
        # Get value of Y (refer to calc)
        $alphaScores = sizeof($this->getAlphaCourseUserIds($alphaCourse));
    
        $otherScores = [];
        # Get array of values for X (refer to calc)
        foreach($unique_arr as $eachitem) {
            $count = array_count_values($arr)[$eachitem];
            array_push($otherScores, $count);
        }

        $result = [];
        # Get array of Assoc values (refer to calc)
        for ($i=0; $i < sizeof($otherScores); $i++) { 
            $assoc = ($alphaScores + $otherScores[$i]) / $alphaScores;
            $courseTitle = $unique_arr[$i];
            $result[$courseTitle] = $assoc;
        }
        arsort($result);
        return array_slice($result, 0, $resultCount);
    }
}
