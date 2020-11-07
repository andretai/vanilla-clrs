<?php

namespace App\Http\Livewire\Ms;

use Illuminate\Support\Facades\DB;
use Livewire\Component;

class SearchCategories extends Component
{
    public $search = '';
    public $perpage = 5;
    public $checked = false;

    public function render()
    {
        if($this->search === '') {
            return view('livewire.ms.search-categories', [
                'categories' => DB::table('categories')->paginate($this->perpage)
            ]);
        } else {
            return view('livewire.ms.search-categories', [
                'categories' => DB::table('categories')
                                ->where('category', 'like', '%'.$this->search.'%')
                                ->paginate($this->perpage)
            ]);
        }
    }
}
