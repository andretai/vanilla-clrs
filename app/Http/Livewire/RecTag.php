<?php

namespace App\Http\Livewire;

use App\Models\Course;
use App\Models\Favourite;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class RecTag extends Component
{
    public $order;
    public function render()
    {
        $tag_file = Storage::get('keywords_weights.json');
        $tag = json_decode($tag_file, true);
        $tag_keyword = $this->getTag($tag);
        $course_contain_related_keyword = $this->getRelatedCourse($tag_keyword, $tag);

        //if no similar course is found (no similar tag), recommend same category course as the course in favourite list
        if (!empty($course_contain_related_keyword)) {
            $unique_course_id = array_unique($course_contain_related_keyword);
            $random_index = array_rand($unique_course_id, 5);
            $recTag = $this->getCourseDetails($random_index, $unique_course_id);
        } else {
            $favourite = Favourite::select('course_id')
            ->where('user_id',Auth::User()->id)->get()->toArray();
            $random_course_id = array_rand($favourite, 1);
            $course = Course::where('id', $favourite[$random_course_id]['course_id'])->first();
            $filterCategory = Course::where('category_id', $course->category_id)
                ->take(5)
                ->get();
            $recTag = $filterCategory;
        }

        return view('livewire.rec-tag', compact('recTag'));
    }

    public function mount()
    {
        $this->order = DB::table('recommendations')->where('key', 'recTag')->get()->toArray();
    }
    //get all the tag from the json file
    public function getTag($tag)
    {
        $getTag = [];
        $favourite_courses = Favourite::where('user_id', Auth::User()->id)->get();
        $available_course = [];
        foreach ($favourite_courses as $course) {
            $course_id = intval($course->course_id);
            $array_index = array_search($course_id, array_column($tag, 'course_id'));
            if ($array_index != false) {
                array_push($available_course, $tag[$array_index]);
            }
        }
        foreach ($available_course as $course) {
            foreach ($course['keywords'] as $keyword) {
                array_push($getTag, $keyword);
            }
        }
        return $getTag;
    }
    //get the course that has the same tags with the course in favourite list
    public function getRelatedCourse($tag_keyword, $tag)
    {
        $course_contain_related_keyword = [];
        foreach ($tag_keyword as $keyword) {
            foreach ($tag as $t) {
                $find_course = array_search($keyword, $t['keywords']);
                if ($find_course != false) {
                    array_push($course_contain_related_keyword, $t['course_id']);
                }
            }
        }
        return $course_contain_related_keyword;
    }
    //get the course details
    public function getCourseDetails($index, $course_id)
    {
        $course_details = [];
        foreach ($index as $i) {
            $course = Course::where('id', $course_id[$i])->first();
            array_push($course_details, $course);
        }
        return $course_details;
    }
}
