<?php

namespace App\Http\Controllers\Recommend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\Course;

class CollabFil extends Controller
{
    public function getRecommendations($alphaUser, $resultCount, $type) {
        return $this->calc_collab($type, $alphaUser, $resultCount);
    }

    public function getBetaUser($alphaUser)
    {
        $betaUser = app('App\Http\Controllers\Recommend\VectorUser')->calc_vector($alphaUser)[1][0];
        return $betaUser;
    }

    public function getBetaCourses($type, $alphaUser)
    {
        $betaUserId = $this->getBetaUser($alphaUser)['user_id'];
        $results = DB::table($type)->select('course_id')->where('user_id', $betaUserId)->distinct()->get()->toArray();
        $betaCourses = [];
        foreach($results as $result) {
            array_push($betaCourses, $result->course_id);
        }
        return $betaCourses;
    }

    public function getFilteredBetaCourses($type, $alphaUser)
    {
        $betaCourses = $this->getBetaCourses($type, $alphaUser);
        $alphaUserId = app('App\Http\Controllers\Recommend\VectorUser')->calc_vector($alphaUser)[0];
        $results = DB::table($type)->select('course_id')->where('user_id', $alphaUserId)->distinct()->get()->toArray();
        $alphaCourses = [];
        foreach($results as $result) {
            array_push($alphaCourses, $result->course_id);
        }
        $filtered = array_diff($betaCourses, $alphaCourses);
        return array_values($filtered);
    }

    public function calc_collab($type, $alphaUser, $resultCount)
    {
        $filteredBetaCourses = $this->getFilteredBetaCourses($type, $alphaUser);
        $results = [];
        foreach($filteredBetaCourses as $course) {
            $res =Course::where('id', $course)->first();
            array_push($results, $res);
        }
        $results = array_slice($results, 0, $resultCount);
        return $results;
    }
}


