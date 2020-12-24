<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Course;
use Livewire\WithPagination;
use App\Models\Category;

class Search extends Component
{
    use WithPagination;

    public $search;
    public $category;
    public $categories;

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $this->categories = Category::get();
        $searchTerm = '%' . $this->search . '%';

        if ($this->category) {
            return view('livewire.search', [
                'courses' => Course::where('title', 'LIKE', $searchTerm)
                    ->where('category_id', $this->category)->paginate(30)
            ]);
        } else {
            return view('livewire.search', [
                'courses' => Course::where('title', 'LIKE', $searchTerm)->paginate(30)
            ]);
        }
    }
}
