<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\DB;
use Livewire\Component;

class SearchCourses extends Component
{
    public $search = '';

    public function render()
    {
        if($this->search === '') {
            return view('livewire.ms.search-courses', [
                'courses' => DB::table('courses')->get()
            ]);
        } else {
            return view('livewire.ms.search-courses', [
                'courses' => DB::table('courses')->where('title', 'like', '%'.$this->search.'%')->get()
            ]);
        }
        
    }
}
