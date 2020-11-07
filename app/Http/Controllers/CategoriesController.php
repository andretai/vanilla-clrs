<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoriesController extends Controller
{
    public function store(Request $request) {
        $request->validate([
            'category' => 'required',
            'image' => ''
        ]);
        $category = new Category;
        $category->category = $request->category;
        if($request->image) {
            $category->image = $request->image;
        }
        $category->save();
        return view('ms.api.add', [
            'back' => route('ms-category'),
            'item_type' => 'category',
            'item_fields' => $this->categoryFields([])
        ]);
    }

    public function update(Request $request) {
        $item_id = $request->query('id');
        $request->validate([
            'category' => 'required',
            'image' => ''
        ]);
        DB::table('categories')->where('id', $item_id)->update([
            'category' => $request->category,
            'image' =>  $request->image
        ]);
        return view('ms.api.edit', [
            'back' => route('ms-category'),
            'item_id' => $item_id,
            'item_type' => 'category',
            'item_fields' => $this->categoryFieldsValues($request)
        ]);
    }

    public function delete(Request $request) {
        $item_id = $request->query('id');
        DB::table('categories')->delete($item_id);
        $categories = Category::all();
        return view('ms.pages.category', [
            'categories' => $categories,
            'delete_message' => 'Category deleted.'
        ]);
    }

    public function categoryFields($item_fields) {
        array_push($item_fields, (object) array('name' => 'category', 'type' => 'text'));
        array_push($item_fields, (object) array('name' => 'image', 'type' => 'text'));
        return $item_fields;
    }

    public function categoryFieldsValues($item) {
        $item_values = [];
        array_push($item_values, (object) array('name' => 'category', 'type' => 'text', 'value' => $item->category));
        array_push($item_values, (object) array('name' => 'image', 'type' => 'text', 'value' => $item->image));
        return $item_values;
    }
}
