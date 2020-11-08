<?php

namespace App\Http\Livewire\Ms;

use Illuminate\Support\Facades\DB;
use Livewire\Component;

class SearchPromotions extends Component
{
    public $search = '';
    public $perpage = 5;
    public $checked = false;

    public function render()
    {
        if($this->search === '') {
            return view('livewire.ms.search-promotions', [
                'promotions' => DB::table('promotions')->paginate($this->perpage)
            ]);
        } else {
            return view('livewire.ms.search-promotions', [
                'promotions' => DB::table('promotions')
                                ->where('promotion', 'like', '%'.$this->search.'%')
                                ->paginate($this->perpage)
            ]);
        }
    }
}
