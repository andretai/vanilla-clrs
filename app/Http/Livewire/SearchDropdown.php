<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Course;
class SearchDropdown extends Component
{
    public $query;
    public $courses;

    public function mount()
    {
        $this->query = '';
        $this->contacts = [];
    }

    public function resetValues()
    {
        $this->reset(['query', 'courses']);
    }
    public function updatedQuery()
    {
        $this->courses = Course::where('title', 'like', '%' .$this->query. '%')
        ->get()
        ->toArray();
    }
    public function render()
    {
        return view('livewire.search-dropdown');
    }
}
