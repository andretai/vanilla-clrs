<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\RecommendationsRating;
use Illuminate\Support\Facades\Auth;

class RecFeedbacks extends Component
{
    public $rec;
    public $like = false;
    public $dislike = false;
    public $user;

    public function mount()
    {
        $this->user = Auth::User();
        $data = RecommendationsRating::where('user_id', $this->user->id)
            ->where('rec_id', $this->rec)->first();
        if ($data) {
            if ($data->sentiment) {
                $this->like = true;
            } else {
                $this->dislike = true;
            }
        }
    }

    public function render()
    {
        return view('livewire.rec-feedbacks');
    }
    public function like()
    {
        $data = RecommendationsRating::where('user_id', $this->user->id)
            ->where('rec_id', $this->rec)->first();
        if (!$data) {
            $createLike = RecommendationsRating::create(
                [
                    'rec_id' => $this->rec,
                    'user_id' => $this->user->id,
                    'sentiment' => true
                ]
            );
        } else {
            $updateLike = RecommendationsRating::where('user_id', $this->user->id)
                ->where('rec_id', $this->rec)
                ->update([
                    'sentiment' => true
                ]);
        }
        session()->flash('review', 'Thank you for your review!');
    }

    public function dislike()
    {
        $data = RecommendationsRating::where('user_id', $this->user->id)
            ->where('rec_id', $this->rec)->first();
        if (!$data) {
            $createDislike = RecommendationsRating::create(
                [
                    'rec_id' => $this->rec,
                    'user_id' => $this->user->id,
                    'sentiment' => false
                ]
            );
        } else {
            $updateDislike = RecommendationsRating::where('user_id', $this->user->id)
                ->where('rec_id', $this->rec)
                ->update([
                    'sentiment' => false
                ]);
        }
        session()->flash('review', 'Thank you for your review!');
    }

    public function undo()
    {
        $undo = RecommendationsRating::where('user_id', $this->user->id)
            ->where('rec_id', $this->rec)->delete();
        session()->flash('undo', 'Review has been undo!');
    }

    public function getLikedProperty()
    {
        return RecommendationsRating::where('user_id', $this->user->id)
            ->where('rec_id', $this->rec)->where('sentiment', true)->exists();
    }
    public function getDislikedProperty()
    {
        return RecommendationsRating::where('user_id', $this->user->id)
            ->where('rec_id', $this->rec)->where('sentiment', false)->exists();
    }
}
