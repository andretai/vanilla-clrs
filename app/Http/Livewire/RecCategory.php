<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Favourite;
use Illuminate\Support\Facades\DB;

class RecCategory extends Component
{
    public function render()
    {
        
        $recCategory = Favourite::leftJoin('courses', 'favourites.course_id', '=', 'courses.id')
            ->select('favourites.id', 'favourites.course_id', 'courses.*', DB::raw('count(courses.category_id) as total'))
            ->groupBy('courses.category_id')
            ->orderBy('total', 'DESC')
            ->take(10)
            ->get();

        return view('livewire.rec-category', compact('recCategory'));
    }
}
