<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class RecReview extends Component
{
    public function render()
    {
        $user = Auth::User();
        $recReview = app('App\Http\Controllers\Recommend\CollabFil')->getRecommendations($user->id, 5, 'ratings');
        //var_dump($ratingRec);
        
        return view('livewire.rec-review',compact('recReview'));
    }
}
