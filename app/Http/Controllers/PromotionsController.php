<?php

namespace App\Http\Controllers;

use App\Models\Promotion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PromotionsController extends Controller
{
    public function store(Request $request) {
        $request->validate([
            'title' => 'required',
            'description' => '',
            'image' => '',
            'start_date' => '',
            'end_date' => '',
            'url' => 'required'
        ]);
        $promotion = new Promotion;
        $promotion->title = $request->title;
        $promotion->description = $request->description;
        $promotion->image = $request->image;
        $promotion->start_date = $request->start_date;
        $promotion->end_date = $request->end_date;
        $promotion->url = $request->url;
        $promotion->save();
        return view('ms.api.add', [
            'back' => route('ms-promotion'),
            'item_type' => 'promotion',
            'item_fields' => $this->promotionFields([])
        ]);
    }

    public function update(Request $request) {
        $item_id = $request->query('id');
        $request->validate([
            'title' => 'required',
            'description' => '',
            'image' => '',
            'start_date' => '',
            'end_date' => '',
            'url' => 'required'
        ]);
        DB::table('promotions')->where('id', $item_id)->update([
            'title' => $request->title,
            'description' => $request->description,
            'image' => $request->image,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'url' => $request->url
        ]);
        return view('ms.api.edit', [
            'back' => route('ms-promotion'),
            'item_type' => 'promotion',
            'item_id' => $item_id,
            'item_fields' => $this->promotionFieldsValues($request)
        ]);
    }

    public function delete(Request $request) {
        $item_id = $request->query('id');
        DB::table('promotions')->delete($item_id);
        $promotions = Promotion::all();
        return view('ms.pages.promotion', [
            'promotions' => $promotions,
            'delete_message' => 'Promotion deleted.'
        ]);
    }

    public function promotionFields($item_fields) {
        array_push($item_fields, (object) array('name' => 'title', 'type' => 'text'));
        array_push($item_fields, (object) array('name' => 'description', 'type' => 'text'));
        array_push($item_fields, (object) array('name' => 'image', 'type' => 'text'));
        array_push($item_fields, (object) array('name' => 'start_date', 'type' => 'date'));
        array_push($item_fields, (object) array('name' => 'end_date', 'type' => 'date'));
        array_push($item_fields, (object) array('name' => 'url', 'type' => 'text'));
        return $item_fields;
    }

    public function promotionFieldsValues($item) {
        $item_values = [];
        array_push($item_values, (object) array('name' => 'title', 'type' => 'text', 'value' => $item->title));
        array_push($item_values, (object) array('name' => 'description', 'type' => 'text', 'value' => $item->description));
        array_push($item_values, (object) array('name' => 'image', 'type' => 'text', 'value' => $item->image));
        array_push($item_values, (object) array('name' => 'start_date', 'type' => 'date', 'value' => $item->start_date));
        array_push($item_values, (object) array('name' => 'end_date', 'type' => 'date', 'value' => $item->end_date));
        array_push($item_values, (object) array('name' => 'url', 'type' => 'text', 'value' => $item->url));
        return $item_values;
    }
}
