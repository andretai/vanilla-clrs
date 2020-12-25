<?php

namespace App\Http\Livewire;

use Livewire\Component;
class Newsletter extends Component
{
    public $data =[];

    public function render()
    {
        
        return view('livewire.newsletter');
    }

    public function doWebScraping()
    {

    }


}
