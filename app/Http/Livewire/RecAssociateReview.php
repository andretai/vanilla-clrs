<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Course;
class RecAssociateReview extends Component
{
    public $category=[];
    public $course_id;
    public function render()
    {
        $rec = app('App\Http\Controllers\Recommend\CalcAssoc')->getRecommendations($this->course_id, 5, 'ratings');
        return view('livewire.rec-associate-review', compact('rec'));
    }

    public function mount()
    {
        $course = Course::where('id',$this->course_id)->first();
        $filterCategory = Course::where('category_id', $course->category_id)
            ->take(5)
            ->get();
        $this->category[0] = $filterCategory;
            
    }
}
