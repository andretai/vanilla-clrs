<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Guidelines extends Component
{
    public $isOpenHome = 0;
    public $isOpenCourse = 0;
    public $isOpenFavourite = 0;
    public $isOpenPromotion = 0;
    public $open_guidelines = false;

    public function render()
    {
        if (Auth::User()) {
            if (Auth::User()->check_guidelines) {
                $this->open_guidelines = true;
                Auth::User()->check_guidelines = false;
                Auth::User()->save();
            } else {
                $this->open_guidelines = false;
            }
        }

        return view('livewire.guidelines');
    }

    public function create()
    {
        $this->openHomeModal();
    }

    public function openHomeModal()
    {
        $this->isOpenHome = true;
        $this->isOpenCourse = false;
        $this->isOpenFavourite = false;
        $this->isOpenPromotion = false;
    }
    public function openCourseModal()
    {
        $this->isOpenHome = false;
        $this->isOpenCourse = true;
        $this->isOpenFavourite = false;
        $this->isOpenPromotion = false;
    }
    public function openFavouriteModal()
    {
        $this->isOpenHome = false;
        $this->isOpenCourse = false;
        $this->isOpenFavourite = true;
        $this->isOpenPromotion = false;
    }
    public function openPromotionModal()
    {
        $this->isOpenHome = false;
        $this->isOpenCourse = false;
        $this->isOpenFavourite = false;
        $this->isOpenPromotion = true;
    }

    public function closeModal()
    {
        $this->isOpenHome = false;
        $this->isOpenCourse = false;
        $this->isOpenFavourite = false;
        $this->isOpenPromotion = false;
    }
}
