<?php

namespace App\Http\Livewire\Ms;

use App\Models\Course;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class AssociateCourses extends Component
{
    /**
     * Terms
     *  alpha course = the sole primary course
     *  alpha users = the users who have rated the alphaCourse
     *  beta courses = the other secondary courses
     */

    public $metric = 'ratings';
    public $alphaCourse = 2;
    public $resultCount = 5;

    public function render()
    {
        $ratedCourses = app('\App\Http\Controllers\Recommend\CalcAssoc')->getRatedCourses($this->metric);
        if(sizeof($ratedCourses) > 0) {
            return view('livewire.ms.associate-courses', [
                'courses' => $ratedCourses,
                'results' => app('\App\Http\Controllers\Recommend\CalcAssoc')->getRecommendations($this->alphaCourse, $this->resultCount, $this->metric),
                'alphaCourseId' => $this->alphaCourse
            ]);
        } else {
            return view('livewire.ms.associate-courses', [
                'courses' => [],
                'assoc' => []
            ]);
        }
        
    }
}
