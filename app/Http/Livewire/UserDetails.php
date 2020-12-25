<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
class UserDetails extends Component
{
    public function render()
    {
        $user = Auth::User();

        return view('livewire.user-details',compact('user'));
    }
}
