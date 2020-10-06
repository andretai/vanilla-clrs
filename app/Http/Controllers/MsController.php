<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Route;

class MsController extends Controller
{
    public function index() {
        return view('ms.index');
    }

    public function add(Request $request) {
        $item_type = $request->query('item_type');
        $item_fields = [];
        switch($item_type) {
            case 'course': 
                array_push($item_fields, (object) array('name' => 'title', 'type' => 'text'));
                array_push($item_fields, (object) array('name' => 'description', 'type' => 'text'));
                array_push($item_fields, (object) array('name' => 'image', 'type' => 'text'));
                array_push($item_fields, (object) array('name' => 'url', 'type' => 'text'));
                array_push($item_fields, (object) array('name' => 'price', 'type' => 'number'));
                array_push($item_fields, (object) array('name' => 'platform', 'type' => 'text'));                
                break;
            default:
                break;
        }
        return view('ms.api.add', [
            'back' => route('ms-' . $item_type),
            'item_type' => $item_type,
            'item_fields' => $item_fields
        ]);
    }
}
