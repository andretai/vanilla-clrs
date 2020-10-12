<?php

namespace App\Http\Livewire\Ms;

use Illuminate\Support\Facades\DB;
use Livewire\Component;

class VectorUsers extends Component
{
    public $alphaUser = 4;

    public function render()
    {
        return view('livewire.ms.vector-users', [
            'alpha' => $this->alphaUser,
            'result' => $this->calc_vector()
        ]);
    }

    /**
     * 
     * @return all course_id favorited by alpha user
     */
    public function getAlphaUserFavoritedCourseIds()
    {
        $alphaFavs = DB::table('favorites')->select('course_id')->where('user_id', $this->alphaUser)->get()->toArray();
        $alphaUserFavoritedCourseIds = [];
        foreach($alphaFavs as $alphaFav) {
            array_push($alphaUserFavoritedCourseIds, $alphaFav->course_id);
        }
        return $alphaUserFavoritedCourseIds;
    }

    /**
     * 
     * @return all user_id of non-alpha users that have favorited at least 1 course
     */
    public function getNonAlphaUsersIds()
    {
        $nonAlphaUsers = DB::table('favorites')->select('user_id')->where('user_id', '!=', $this->alphaUser)->distinct()->get()->toArray();
        $nonAlphaUsersIds = [];
        foreach($nonAlphaUsers as $nonAlphaUser) {
            array_push($nonAlphaUsersIds, $nonAlphaUser->user_id);
        }
        return $nonAlphaUsersIds;
    }

    /**
     * This method aims to calculate the vector scores between the alpha user and non-alpha users.
     * Higher vector score means greater similarity between the alpha user and a non-alpha user in terms of favorites.
     * In simpler terms, user A and user B both rated on the same few courses.
     * However, user A and user B each has favorited different number of courses, for example, user A favorited 20 courses while user B favorited 100 courses.
     * This means user B may be more generous in favoriting courses, making it a less significant factor.
     * Hence, the proportions of favorites also carries weight, as you will notice in the calculation.
     */
    public function calc_vector()
    {
        # How to Calculate Vector
        # Vector score = ( X1 * X1 / X2 ) * ( X1 * X1 / X3 )
        # Where
        #       X1 = Number of courses favorited by both alpha and non-alpha users
        #       X2 = Total number of favorites by alpha user
        #       X3 = Total number of favorites by non-alpha user

        $alphaFavs = $this->getAlphaUserFavoritedCourseIds();
        $nonAlphaUsers = $this->getNonAlphaUsers();
        $vector_scores = [];
        # Iterate through non-alpha users to calculate each vector score with alpha user
        foreach($nonAlphaUsers as $nonAlphaUser) {
            # Get all courses favorited by this user
            $favoritedCourses = DB::table('favorites')->select('course_id')
                                                      ->where('user_id', $nonAlphaUser)
                                                      ->distinct()
                                                      ->get()
                                                      ->toArray();
            $count = 0;
            # Iterate through courses favorited by the alpha users and find any identical courses favorited by the non-alpha user.
            foreach($alphaFavs as $alphaFav) {
                foreach($favoritedCourses as $favoritedCourse) {
                    if($alphaFav === $favoritedCourse->course_id) {
                        $count++;
                    }
                }
            }
            # With the values we needed we calculate the vector score for a user in each iteration (refer to calculation).
            $alpha = $count * ( $count / sizeof($alphaFavs) );
            $nonAlpha = $count * ( $count / sizeof($favoritedCourses) );
            $vector_score = $alpha * $nonAlpha;
            $vector_scores[$nonAlphaUser] = $vector_score;
        }
        arsort($vector_scores);
        return array('user_id' => array_key_first($vector_scores), 'vector_score' => reset($vector_scores));
    }
}
