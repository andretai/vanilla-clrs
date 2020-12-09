<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\DB;
use Livewire\Component;

class SearchUsers extends Component
{
    public $search = '';
    public $perpage = 7;

    public function render()
    {
        if($this->search === '') {
            return view('livewire.search-users', [
                'users' => DB::table('users')->paginate($this->perpage)
            ]);
        } else {
            return view('livewire.search-users', [
                'users' => DB::table('users')->where('name', 'like', '%'.$this->search.'%')->paginate($this->perpage)
            ]);
        }
    }
}
