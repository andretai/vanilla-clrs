<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
class RecReview extends Component
{
    public $order;

    public function render()
    {
        $user = Auth::User();
        $recReview = app('App\Http\Controllers\Recommend\CollabFil')->getRecommendations($user->id, 5, 'ratings');
        return view('livewire.rec-review',compact('recReview'));
    }
    public function mount()
    { 
        $this->order = DB::table('recommendations')->where('key','recReview')->get()->toArray();
        
    }
}
