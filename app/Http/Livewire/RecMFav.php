<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Favourite;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Recommendation;

class RecMFav extends Component
{
    public $order;

    public function render()
    {
        $mFav = Favourite::leftJoin('courses', 'favourites.course_id', '=', 'courses.id')
            ->select('course_id', DB::raw('count(*) as total'))
            ->groupBy('course_id')
            ->orderBy('total', 'DESC')
            ->take(5)
            ->get();

        return view('livewire.rec-m-fav', compact('mFav'));
    }

    public function mount()
    { 
        $this->order = DB::table('recommendations')->where('key','mFav')->get()->toArray();
        
    }
}
