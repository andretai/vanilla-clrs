<?php

namespace App\Http\Composers;

use App\Models\User;
use App\Models\Favourite;
use Auth;
use Illuminate\Contracts\View\View;
class NavbarComposer
{
    public function compose(View $view)
    {
        $user = Auth::User();
        if(is_null($user)){
            $view->with('favCount',0);
        }else{
            $favCount = Favourite::where('user_id',$user->id)->count();
            $view->with('favCount',$favCount);
        }
    }
}