<?php

namespace App\Http\Livewire\Ms;

use Livewire\Component;

class Chartjs extends Component
{    
    public $charts;
    public $col;

    public function render()
    {
        return view('livewire.ms.chartjs', [ 
            'charts' => $this->charts,
            'col' => $this->col
        ]);
    }
}
