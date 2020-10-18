<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Arr;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $categories = Category::all();
        return view('home')->with(['categories'=>$categories]);
    }

    public function seedCategory()
    {
        $categories = ['Art','Computer','Cooking','Dance','Exercise','Gardening','Health','Language'];
        
        foreach($categories as $category)
        {
            $result = Category::insert(
                ['category' => $category, 'image' =>'images/'.$category.'.jpg']
            );
        }
        return Category::all();
    }
}
