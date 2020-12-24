<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Goutte\Client;
class Newsletter extends Component
{
    public $data =[];

    public function render()
    {
        $url_to_traverse = 'https://html.duckduckgo.com/html/?q=Laravel';
        $client = new Client();
        $crawler = $client->request('GET', $url_to_traverse);
        $test = $crawler->filter('.result__title .result__a')->each(function ($node){
            dump($node->text());
            array_push($this->data,$node->text());
        });
      
        
        return view('livewire.newsletter');
    }

    public function doWebScraping()
    {

    }


}
