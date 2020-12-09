<?php

namespace App\Http\Livewire\Ms;

use Illuminate\Support\Facades\DB;
use Livewire\Component;

use function Aws\filter;

class DescTags extends Component
{
    public $course_id = 1;

    public function render()
    {
        $related = $this->findCoursesWithSimilarTags();
        $tags = $this->getKeywords();
        return view('livewire.ms.desc-tags', [
            'tags' => $tags,
            'courses' => DB::table('courses')->get(),
            'related' => $related
        ]);
    }

    public function getKeywords() {
        if(DB::table('tags')->where('course_id', $this->course_id)->first()) {
            $keywords = DB::table('tags')->select('keywords')->where('course_id', '=', $this->course_id)->get()->toArray()[0]->keywords;
            return preg_split("/ /", $keywords);
        }
    }

    public function findCoursesWithSimilarTags() {
        $tags = DB::table('tags')->where('type', '=', 'descriptive')->get()->toArray();
        $keywords_arr = $this->getKeywords();
        $courses = [];
        foreach ($tags as $tag) {
            $score = 0;
            $course = DB::table('courses')->where('id', $tag->course_id)->first();
            if($tag->course_id == $this->course_id) {
                continue;
            }
            if($keywords_arr) {
                foreach ($keywords_arr as $keyword) {
                    if(str_contains($tag->keywords, $keyword)) {
                        $score = $score + 1;
                    }
                }
            }
            if($score > 0) {
                array_push($courses, (object) array('course' => $course, 'score' => $score, 'kw' => $tag->keywords));
            }
        }
        $col = array_column($courses, 'score');
        array_multisort($col, SORT_DESC, $courses);
        return array_slice($courses, 0, 5);
    }
}
