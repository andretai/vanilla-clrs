<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class RecFav extends Component
{
    public function render()
    {
        
        $user = Auth::User();
        
        //print_r($rating);
       
        $recFav = app('App\Http\Controllers\Recommend\CollabFil')->getRecommendations($user->id, 5, 'favourites');
        
        return view('livewire.rec-fav', compact('recFav'));
    }
}
