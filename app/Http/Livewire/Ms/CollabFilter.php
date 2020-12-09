<?php

namespace App\Http\Livewire\Ms;

use Illuminate\Support\Facades\DB;
use Livewire\Component;

class CollabFilter extends Component
{
    public $type = 'ratings';
    public $alphaUser = 1;
    public $userCount;

    public function render()
    {
        return view('livewire.ms.collab-filter', [
            'type' => $this->type,
            'userCount' => $this->userCount,
            'results' => $this->calc_collab($this->type, $this->alphaUser)
        ]);
    }

    public function getBetaUser($alphaUser)
    {
        $betaUser = app(VectorUsers::class)->calc_vector($alphaUser)[1][0];
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
        $alphaUserId = app(VectorUsers::class)->calc_vector($alphaUser)[0];
        $results = DB::table($type)->select('course_id')->where('user_id', $alphaUserId)->distinct()->get()->toArray();
        $alphaCourses = [];
        foreach($results as $result) {
            array_push($alphaCourses, $result->course_id);
        }
        $filtered = array_diff($betaCourses, $alphaCourses);
        return array_values($filtered);
    }

    public function calc_collab($type, $alphaUser)
    {
        $filteredBetaCourses = $this->getFilteredBetaCourses($type, $alphaUser);
        $results = [];
        foreach($filteredBetaCourses as $course) {
            $res = DB::table('courses')->where('id', $course)->first();
            array_push($results, $res->title);
        }
        return $results;
    }
}
