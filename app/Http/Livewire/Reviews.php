<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Carbon;
use App\Models\Rating;

class Reviews extends Component
{
    
    public $reviews;

    public $newReview;

    public function mount(){
        $initialReviews = Rating::all();
        $this->reviews = $initialReviews;
    }

    public function addReview()
    {
        if($this->newReview == ''){
            return;
        }
        array_unshift($this->reviews, [
            'body' => $this->newReview,
            'created_at' => Carbon::now()->diffForHumans(),
            'creator' => 'Admin'
        ]);
        $this->newReview = "";
    }

    public function render()
    {
        return view('livewire.reviews');
    }
}
