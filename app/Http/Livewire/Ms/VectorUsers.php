<?php

namespace App\Http\Livewire\Ms;

use Illuminate\Support\Facades\DB;
use Livewire\Component;

class VectorUsers extends Component
{
    public $alphaUser = 3;

    public function render()
    {
        return view('livewire.ms.vector-users', [
            'result' => $this->calc_vector($this->alphaUser)
        ]);
    }

    public function getAlphaUserFavouritedCourseIds($alphaUser)
    {
        $alphaFavs = DB::table('favourites')->select('course_id')->where('user_id', $alphaUser)->get()->toArray();
        $alphaUserFavouritedCourseIds = [];
        foreach($alphaFavs as $alphaFav) {
            array_push($alphaUserFavouritedCourseIds, $alphaFav->course_id);
        }
        return $alphaUserFavouritedCourseIds;
    }

    public function getNonAlphaUsersIds($alphaUser)
    {
        $nonAlphaUsers = DB::table('favourites')->select('user_id')->where('user_id', '!=', $alphaUser)->distinct()->get()->toArray();
        $nonAlphaUsersIds = [];
        foreach($nonAlphaUsers as $nonAlphaUser) {
            array_push($nonAlphaUsersIds, $nonAlphaUser->user_id);
        }
        return $nonAlphaUsersIds;
    }

    /**
     * This method aims to calculate the vector scores between the alpha user and non-alpha users.
     * Higher vector score means greater similarity between the alpha user and a non-alpha user in terms of favourites.
     * In simpler terms, user A and user B both rated on the same few courses.
     * However, user A and user B each has favourited different number of courses, for example, user A favourited 20 courses while user B favourited 100 courses.
     * This means user B may be more generous in favoriting courses, making it a less significant factor.
     * Hence, the proportions of favourites also carries weight, as you will notice in the calculation.
     */
    public function calc_vector($alphaUser)
    {
        # How to Calculate Vector
        # Vector score = ( X1 * X1 / X2 ) * ( X1 * X1 / X3 )
        # Where
        #       X1 = Number of courses favourited by both alpha and non-alpha users
        #       X2 = Total number of favourites by alpha user
        #       X3 = Total number of favourites by non-alpha user

        $alphaFavs = $this->getAlphaUserFavouritedCourseIds($alphaUser);
        $nonAlphaUsers = $this->getNonAlphaUsersIds($alphaUser);
        $vector_scores = [];
        # Iterate through non-alpha users to calculate each vector score with alpha user
        foreach($nonAlphaUsers as $nonAlphaUser) {
            # Get all courses favourited by this user
            $favouritedCourses = DB::table('favourites')->select('course_id')
                                                      ->where('user_id', $nonAlphaUser)
                                                      ->distinct()
                                                      ->get()
                                                      ->toArray();
            $count = 0;
            # Iterate through courses favourited by the alpha users and find any identical courses favourited by the non-alpha user.
            foreach($alphaFavs as $alphaFav) {
                foreach($favouritedCourses as $favouritedCourse) {
                    if($alphaFav === $favouritedCourse->course_id) {
                        $count++;
                    }
                }
            }
            # With the values we needed we calculate the vector score for a user in each iteration (refer to calculation).
            $alpha = $count * ( $count / sizeof($alphaFavs) );
            $nonAlpha = $count * ( $count / sizeof($favouritedCourses) );
            $vector_score = $alpha * $nonAlpha;
            $vector_scores[$nonAlphaUser] = $vector_score;
        }
        arsort($vector_scores);
        $result = [];
        # Because the array vector_scores is an associative array (does not have keys)
        # We will need to create an array of keys from the associative array so that we can loop through it
        $keys = array_keys($vector_scores);
        for ($i=0; $i < 5 ; $i++) { 
            # Because we have they key, we can use it to get elements from the vector_scores' associative array
            $array = array('user_id' => $keys[$i], 'vector_score' => $vector_scores[$keys[$i]]);
            array_push($result, $array);
        }
        return [$alphaUser, $result];
    }
}
