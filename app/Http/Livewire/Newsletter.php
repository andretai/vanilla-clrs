<?php

namespace App\Http\Livewire;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Newsletter extends Component
{
    public $data;

    public function render()
    {
        $news = DB::table('newsletters')->orderBy('date','DESC')->paginate(10);
        return view('livewire.newsletter')
        ->with('news',$news);
    }




}
