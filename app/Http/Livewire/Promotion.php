<?php

namespace App\Http\Livewire;

use App\Models\Favourite;
use App\Models\Mission;
use App\Models\Promotion as ModelsPromotion;
use App\Models\Rating;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use App\Models\MissionStatus;
use Carbon\Carbon;

class Promotion extends Component
{


    public function render()
    {
        $missions = Mission::all();
        $promotions = ModelsPromotion::where("user_id",Auth::User()->id)->get();
        
        return view('livewire.promotion')
            ->with('missions', $missions)
            ->with('promotions', $promotions);
    }


    public function checkProgress($mission)
    {
        if (str_contains($mission->type, "favourite")) {
            $check = Favourite::leftJoin('courses', 'favourites.course_id', '=', 'courses.id')
                ->select('favourites.id', 'favourites.course_id', 'courses.*')
                ->where('user_id', Auth::User()->id)
                ->where('courses.platform_id', $mission->platform_id)
                ->count();

            if ($check >= intval($mission->volume)) {
                return true;
            } else {
                return false;
            }
        } elseif (str_contains($mission->type, "comment")) {
            $check = Rating::where('user_id', Auth::User()->id)
                ->where('platform_id', $mission->platform_id)
                ->count();

            if ($check >= intval($mission->volume)) {
                return true;
            } else {
                return false;
            }
        }
    }
    public function generatePromotion($id)
    {
        $mission = Mission::where('id',$id)->first();
        $user_status = MissionStatus::where('user_id', Auth::User()->id)
            ->where('mission_id', $mission->id)->exists();
        if (!$user_status) {
            $uniqueCode = strtoupper(Auth::User()->name).rand(100,999).$mission->reward;
            $description = "Get " .$mission->reward. "% Discount for the Best " .$mission->platform->platform." Courses With Coupon Codes that Guarantee Great Savings Up To 50USD.";
            $currentDate = Carbon::now()->toDate();
            $end_date = Carbon::now()->addDays(90)->toDate();
            $url = 'https://www.'.$mission->platform->platform.'.com';
            $generatePromo = ModelsPromotion::create(
                [
                    'user_id' => Auth::User()->id,
                    'platform_id'=>$mission->platform_id,
                    'code' => $uniqueCode,
                    'description' =>$description,
                    'start_date' => $currentDate,
                    'end_date' => $end_date,
                    'url' => $url
                ]
            );
            $createMissionStatus = MissionStatus::create(
                [
                    'mission_id' => $mission->id,
                    'user_id'=> Auth::User()->id,
                    'status' => true
                ]
            );
            return redirect()->back()->with('claimed', 'Promotion Code claim successfully!');
        }
    }
    public function getProgress($mission){
        if (str_contains($mission->type, "favourite")) {
            $check = Favourite::leftJoin('courses', 'favourites.course_id', '=', 'courses.id')
                ->select('favourites.id', 'favourites.course_id', 'courses.*')
                ->where('user_id', Auth::User()->id)
                ->where('courses.platform_id', $mission->platform_id)
                ->count();

            if ($check >= intval($mission->volume)) {
                return $mission->volume;
            } else {
                return $check;
            }
        } elseif (str_contains($mission->type, "comment")) {
            $check = Rating::where('user_id', Auth::User()->id)
                ->where('platform_id', $mission->platform_id)
                ->count();

            if ($check >= intval($mission->volume)) {
                return $mission->volume;
            } else {
                return $check;
            }
        }
    }
    public function checkClaim($id)
    {
        return MissionStatus::where('user_id', Auth::User()->id)
            ->where('mission_id', $id)->exists();
    }

    public function refresh()
    {
        return redirect()->back()->with('success','Refresh successfully');
    }
}
