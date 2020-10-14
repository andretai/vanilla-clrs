<?php

namespace App\Http\Livewire\Ms;

use Illuminate\Support\Facades\DB;
use Livewire\Component;

class AssociateCoursesFavs extends Component
{
    /**
     * Terms
     *  alpha course = the sole primary course
     *  alpha users = the users who have rated the alphaCourse
     *  beta courses = the other secondary courses
     */

    public $alphaCourse = 5;
    public $resultCount = 5;

    public function render()
    {
        if($this->getFavoritedCourses() > 0) {
            return view('livewire.ms.associate-courses-favs', [
                'courses' => $this->getFavoritedCourses(),
                'assoc' => $this->calc_assoc(),
                'alphaCourseId' => $this->alphaCourse
            ]);
        } else {
            return view('livewire.ms.associate-courses-favs', [
                'courses' => [],
                'assoc' => []
            ]);
        }
    }

    /**
     * First, we need to find out what courses (course_id) were favorited by users (without duplication) from the favorites table.
     * Then, from the list of course_id, we will get all the course details from the courses table.
     */
    public function getFavoritedCourses()
    {
        $favoritedCourses = [];
        $favs = DB::table('favorites')->select('course_id')->distinct()->get()->toArray();
        foreach($favs as $fav) {
            $favoritedCourse = DB::table('courses')->where('id', $fav->course_id)->first();
            array_push($favoritedCourses, $favoritedCourse);
        }
        return $favoritedCourses;
    }

    /**
     * Next, we want to know which users favorited the alpha course (and to count them later).
     * From the ratings table, we will get the ratingsfavorites for the alpha course and collect the user_id for each of these ratings.
     */
    public function getAlphaCourseUsers()
    {
        $alphaCourse =  $this->getFavoritedCourses()[$this->alphaCourse]->id;
        $alphaCourseFavs = DB::table('favorites')->where('course_id', $alphaCourse)->get()->toArray();
        $alphaCourseUsers = [];
        foreach ($alphaCourseFavs as $alphaCourseFav) {
            array_push($alphaCourseUsers, $alphaCourseFav->user_id);
        }
        return $alphaCourseUsers;
    }

    /**
     * Now, we need to collect the favorites which do not belong to the alpha course.
     * Remember, we want to find out how many users who have favorited the alpha course also favorited another course to calculate what other courses are suitable to recommend.
     */
    public function getBetaCoursesFavs()
    {
        $alphaCourseId = $this->getFavoritedCourses()[$this->alphaCourse]->id;
        $betaCoursesFavs = DB::table('favorites')->where('course_id', '!=', $alphaCourseId)->get()->toArray();
        return $betaCoursesFavs;
    }

    /**
     * We have the beta courses already, we need to eliminate those not favorited by the alpha users and return those that were.
     */
    public function getBetaCoursesByAlphaUsers()
    {
        $alphaCourseUsers = $this->getAlphaCourseUsers();
        $betaCoursesFavs = $this->getBetaCoursesFavs();
        $betaCoursesByAlphaUsers = [];
        foreach($alphaCourseUsers as $alphaCourseUser) {
            foreach($betaCoursesFavs as $betaCourseFav) {
                if($betaCourseFav->user_id === $alphaCourseUser) {
                    $betaCourseTitle = DB::table('courses')->where('id', $betaCourseFav->course_id)->first();
                    array_push($betaCoursesByAlphaUsers, $betaCourseTitle->title);
                }
            }
        }
        return $betaCoursesByAlphaUsers;
    }

    public function calc_assoc()
    {
        # How to Calculate Association
        # Assoc = (Y + X) / Y
        # where 
        #       Y = user count of users who've favorited alpha course,
        #       X = user count of users who've favorited alpha course and a specific beta course.

        $betaCoursesByAlphaUsers = $this->getBetaCoursesByAlphaUsers();

        # In case there's any duplication, most likely during testing because of the database is seeded randomly.
        # array_values() to reindex the array after array_unique().
        $betaCoursesByAlphaUsers_unique = array_values(array_unique($betaCoursesByAlphaUsers));

        # A.k.a. Y (refer to formula).
        $alphaCourseUsers_count = sizeof($this->getAlphaCourseUsers());

        # A.k.a. array containing X values, each value in this array will be used to calculate association for each beta course.
        $betaCourses_count = [];
        
        # To calculate the number of occurences of beta courses that were favorited by the alpha course's users.
        foreach($betaCoursesByAlphaUsers_unique as $betaCourse) {
            $count = array_count_values($betaCoursesByAlphaUsers)[$betaCourse];
            array_push($betaCourses_count, $count);
        }

        $result = [];

        # To calculate the association score for each beta course.
        for ($i=0; $i < sizeof($betaCourses_count) ; $i++) { 
            $assoc = ( $alphaCourseUsers_count + $betaCourses_count[$i] ) / $alphaCourseUsers_count;
            $courseTitle = $betaCoursesByAlphaUsers_unique[$i];
            $result[$courseTitle] = number_format($assoc, 2, '.', ',');
        }

        # Sort in descending order.
        arsort($result);

        return array_slice($result, 0, $this->resultCount);
    }
}
