<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UnewsletterController extends Controller
{
    public function index()
    {

        return view('newsletter');
    }
}
