<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use App\Models\Rating;
use App\Models\User;

class SetsController extends Controller
{
    public function index() {
        return view('ms.pages.setting', [
            'ratings' => Rating::all(),
            'numberOfUsers' => sizeof(User::all())
        ]);
    }
}
