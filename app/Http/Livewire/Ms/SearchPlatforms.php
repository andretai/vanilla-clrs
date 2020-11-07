<?php

namespace App\Http\Livewire\Ms;

use Illuminate\Support\Facades\DB;
use Livewire\Component;

class SearchPlatforms extends Component
{
    public $search = '';
    public $perpage = 5;
    public $checked = false;

    public function render()
    {
        if($this->search === '') {
            return view('livewire.ms.search-platforms', [
                'platforms' => DB::table('platforms')->paginate($this->perpage)
            ]);
        } else {
            return view('livewire.ms.search-platforms', [
                'platforms' => DB::table('platforms')
                                ->where('platform', 'like', '%'.$this->search.'%')
                                ->paginate($this->perpage)
            ]);
        }
    }
}
