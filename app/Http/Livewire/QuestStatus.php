<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Favourite;
use App\Models\MissionStatus;
use App\Models\Promotion;
use App\Models\Rating;
use Illuminate\Support\Facades\Auth;

class QuestStatus extends Component
{
    public $mission;

    public function render()
    {
        return view('livewire.quest-status');
    }

    public function getCompletedProperty()
    {
        if (str_contains($this->mission->type, "favourite")) {
            $check = Favourite::leftJoin('courses', 'favourites.course_id', '=', 'courses.id')
                ->select('favourites.id', 'favourites.course_id', 'courses.*')
                ->where('user_id', Auth::User()->id)
                ->where('courses.platform_id', $this->mission->platform_id)
                ->count();

            if ($check >= intval($this->mission->volume)) {
                return true;
            } else {
                return false;
            }
        } elseif (str_contains($this->mission->type, "comment")) {
            $check = Rating::where('user_id', Auth::User()->id)
                ->where('platform_id', $this->mission->platform_id)
                ->count();

            if ($check >= intval($this->mission->volume)) {
                return true;
            } else {
                return false;
            }
        }
    }
    public function generatePromotion()
    {
        $user_status = MissionStatus::where('user_id', Auth::User()->id)
            ->where('mission_id', $this->mission->id)->exists();
        if (!$user_status) {
            $uniqueCode = strtoupper(Auth::User()->name).rand(100,999).$this->mission->reward;
            $generatePromo = Promotion::create(
                [
                    'user_id' => Auth::User()->id,
                    'platform_id'=>$this->mission->platform_id,
                    'code' => $uniqueCode
                ]
            );
            $createMissionStatus = MissionStatus::create(
                [
                    'mission_id' => $this->mission->id,
                    'user_id'=> Auth::User()->id,
                    'status' => true
                ]
            );
            return redirect()->back()->with('claimed', 'Promotion Code claim successfully!');
        }
    }
    public function getClaimedProperty()
    {
        return MissionStatus::where('user_id', Auth::User()->id)
            ->where('mission_id', $this->mission->id)->exists();
    }
}
