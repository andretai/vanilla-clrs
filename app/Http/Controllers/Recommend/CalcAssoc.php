<?php

namespace App\Http\Controllers\Recommend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\Course;

class CalcAssoc extends Controller
{
    /**
     * Terms
     *  alpha course = the sole primary course
     *  alpha users = the users who have rated the alphaCourse
     *  beta courses = the other secondary courses
     */

    public function getRecommendations($alphaCourse, $resultCount, $metric) {
        return $this->calc_assoc($alphaCourse, $resultCount, $metric);
    }

    /**
     * First, we need to find out what courses (course_id) were rated by users (without duplication) from the ratings table.
     * Then, from the list of course_id, we will get all the course details from the courses table.
     */
    public function getRatedCourses($metric) {
        $ratedCourses = [];
        $ratings = DB::table($metric)->select('course_id')->distinct()->get()->toArray();
        foreach($ratings as $rating) {
            $ratedCourse = Course::where('id', $rating->course_id)->first();
            array_push($ratedCourses, $ratedCourse);
        }
        return $ratedCourses;
    }
    
    /**
     * Next, we want to know which users rated the alpha course (and to count them later).
     * From the ratings table, we will get the ratings for the alpha course and collect the user_id for each of these ratings.
     */
    public function getAlphaCourseUsers($alphaCourse, $metric) {
        $alphaCourseId = $this->getRatedCourses($metric)[$alphaCourse]->id;
        $alphaCourseRatings = DB::table($metric)->where('course_id', $alphaCourseId)->get()->toArray();
        $alphaCourseUsers = [];
        foreach($alphaCourseRatings as $alphaCourseRating) {
            array_push($alphaCourseUsers, $alphaCourseRating->user_id);
        }
        return $alphaCourseUsers;
    }

    /**
     * Now, we need to collect the ratings which do not belong to the alpha course.
     * Remember, we want to find out how many users who have rated the alpha course also rated another course to calculate what other courses are suitable to recommend.
     */
    public function getBetaCoursesRatings($alphaCourse, $metric) {
        $alphaCourseId = $this->getRatedCourses($metric)[$alphaCourse]->id;
        $betaCoursesRatings = DB::table($metric)->where('course_id', '!=', $alphaCourseId)->get();
        return $betaCoursesRatings;
    }

    /**
     * We have the beta courses already, we need to eliminate those not rated by the alpha users and return those that were.
     */
    public function getBetaCoursesByAlphaUsers($alphaCourse, $metric) {
        $alphaCourseUsers = $this->getAlphaCourseUsers($alphaCourse, $metric);
        $betaCoursesRatings = $this->getBetaCoursesRatings($alphaCourse, $metric);
        $betaCourseTitlesByAlphaUsers = [];
        $betaCoursesByAlphaUsers = [];
        foreach($alphaCourseUsers as $alphaCourseUser) {
            foreach($betaCoursesRatings as $betaCoursesRating) {
                if($betaCoursesRating->user_id === $alphaCourseUser) {
                    $betaCourseTitle = Course::where('id', $betaCoursesRating->course_id)->first();
                    // array_push($betaCourseTitlesByAlphaUsers, $betaCourseTitle->title);
                    array_push($betaCourseTitlesByAlphaUsers, $betaCourseTitle->id);
                    array_push($betaCoursesByAlphaUsers, $betaCourseTitle);
                }
            }
        }
        return [$betaCourseTitlesByAlphaUsers, $betaCoursesByAlphaUsers];
    }

    public function calc_assoc($alphaCourse, $resultCount, $metric) 
    {
        # How to Calculate Association
        # Assoc = (Y + X) / Y
        # where 
        #       Y = user count of users who've rated alpha course,
        #       X = user count of users who've rated alpha course and a specific beta course.

        $betaCoursesByAlphaUsers_arr = $this->getBetaCoursesByAlphaUsers($alphaCourse, $metric);
        $betaCoursesByAlphaUsers = $betaCoursesByAlphaUsers_arr[0];
        $betaCourseObjects = $betaCoursesByAlphaUsers_arr[1];
        // dd($betaCourseObjects);
        # In case there's any duplication, most likely during testing because of the database is seeded randomly.
        # array_values() to reindex the array after array_unique().
        // $betaCoursesByAlphaUsers_unique = array_values(array_unique($betaCoursesByAlphaUsers));
        $betaCourseObjects = array_values(array_unique($betaCourseObjects));
        # A.k.a. Y (refer to formula).
        $alphaCourseUsers_count = sizeof($this->getAlphaCourseUsers($alphaCourse, $metric));
        
        # A.k.a. array containing X values, each value in this array will be used to calculate association for each beta course.
        $betaCourses_count = [];

        # To calculate the number of occurences of beta courses that were rated by the alpha course's users.
        // foreach($betaCoursesByAlphaUsers_unique as $betaCourse) {
        foreach($betaCourseObjects as $betaCourse) {
            // $count = array_count_values($betaCoursesByAlphaUsers)[$betaCourse];
            $count = array_count_values($betaCoursesByAlphaUsers)[$betaCourse->id];
            array_push($betaCourses_count, $count);
        }

        $result = [];

        # To calculate the association score for each beta course.
        for ($i=0; $i < sizeof($betaCourses_count); $i++) { 
            $assoc = ($alphaCourseUsers_count + $betaCourses_count[$i]) / $alphaCourseUsers_count;
            // $courseTitle = $betaCoursesByAlphaUsers_unique[$i];
            $courseTitle = $betaCourseObjects[$i];
            // $result[$courseTitle] = number_format($assoc, 2, '.', ',');
            array_push($result, (object) array(
                'assoc' => number_format($assoc, 2, '.', ','),
                'course' => $courseTitle
            ));
        }
        // dd($result);

        # Sort in descending order.
        // arsort($result);
        // usort($result, function ($a, $b) {
        //     return $b->assoc - $a->assoc;
        // });
        $col = array_column($result, 'assoc');
        array_multisort($col, SORT_DESC, $result);

        $result = array_slice($result, 0, $resultCount);

        return $result;
    }
}
