<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Guidelines extends Component
{
    public $isOpenHome = 0;
    public $isOpenCourse = 0;
    public $isOpenFavourite = 0;
    public $isOpenPromotion = 0;


    public function render()
    {
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
