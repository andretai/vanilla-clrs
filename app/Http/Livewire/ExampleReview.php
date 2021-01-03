<?php

namespace App\Http\Livewire;

use Livewire\Component;

class ExampleReview extends Component
{
    public $isOpenReview = false;
    public function render()
    {
        return view('livewire.example-review');
    }
    public function create()
    {
        $this->openReviewModal();
    }

    public function openReviewModal()
    {
        $this->isOpenReview = true;
        
    }
    public function closeModal()
    {
        $this->isOpenReview = false;
    }
}
