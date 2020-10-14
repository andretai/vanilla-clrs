<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rating;

class SetsController extends Controller
{
    public function index() {
        return view('ms.pages.setting', [
            'ratings' => Rating::all(),
            'alphacourseId' => 0
        ]);
    }
}
