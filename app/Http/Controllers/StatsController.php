<?php

namespace App\Http\Controllers;

use App\Models\Rating;
use Illuminate\Http\Request;

class StatsController extends Controller
{
    public function index() {
        return view('ms.pages.stat', [
            'ratings' => Rating::all(),
            'alphacourseId' => 0
        ]);
    }
}
