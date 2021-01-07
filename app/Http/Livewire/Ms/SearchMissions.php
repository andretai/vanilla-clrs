<?php

namespace App\Http\Livewire\Ms;

use Illuminate\Support\Facades\DB;
use Livewire\Component;

class SearchMissions extends Component
{
    public $search = '';
    public $perpage = 5;
    public $checked = false;

    public function render()
    {
        if($this->search === '') {
            return view('livewire.ms.search-missions', [
                'missions' => DB::table('missions')->paginate($this->perpage)
            ]);
        } else {
            return view('livewire.ms.search-missions', [
                'missions' => DB::table('missions')
                                ->where('title', 'like', '%'.$this->search.'%')
                                ->paginate($this->perpage)
            ]);
        }
    }
}
