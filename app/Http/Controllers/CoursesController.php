<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Recommend\AssocAlsoRated;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CoursesController extends Controller
{
    public function getRec() {
        # getRecommendations($idOfAlphaCourse, $numberOfRecommendationResults)
        return dd(app('\App\Http\Controllers\Recommend\CalcAssoc')->getRecommendations(2, 5, 'favorites'));
    }

    public function store(Request $request) {
        $request->validate([
            'title' => 'required',
            'description' => '',
            'image' => '',
            'url' => 'required',
            'price' => 'required',
            'category' => 'required',
            'platform' => 'required'
        ]);
        
        $course = new Course;
        $course->title = $request->title;
        $course->description = $request->description;
        $course->image = $request->image;
        $course->url = $request->url;
        $course->price = $request->price;
        $course->category = $request->category;
        $course->platform = $request->platform;
        $course->save();

        return view('ms.api.add', [
            'back' => route('ms-course'),
            'item_type' => 'course',
            'item_fields' => $this->courseFields([])
        ]);
    }

    public function update(Request $request) {
        $item_id = $request->query('id');

        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'image' => '',
            'url' => 'required',
            'price' => 'required',
            'platform' => 'required'
        ]);

        DB::table('courses')->where('id', $item_id)->update([
            'title' => $request->title,
            'description' => $request->description,
            'image' => $request->image,
            'url' => $request->url,
            'price' => $request->price,
            'platform' => $request->platform
        ]);
        
        return view('ms.api.edit', [
            'back' => route('ms-course'),
            'item_type' => 'course',
            'item_id' => $item_id,
            'item_fields' => $this->courseFieldsValues($request)
        ]);
    }

    public function delete(Request $request) {
        $item_id = $request->query('id');
        DB::table('courses')->delete($item_id);
        $courses = Course::all();
        return view('ms.pages.course', [
            'courses' => $courses,
            'delete_message' => 'Course deleted.'
        ]);
    }

    public function courseFields($item_fields) {
        array_push($item_fields, (object) array('name' => 'title', 'type' => 'text'));
        array_push($item_fields, (object) array('name' => 'description', 'type' => 'text'));
        array_push($item_fields, (object) array('name' => 'image', 'type' => 'text'));
        array_push($item_fields, (object) array('name' => 'url', 'type' => 'text'));
        array_push($item_fields, (object) array('name' => 'price', 'type' => 'text'));
        array_push($item_fields, (object) array('name' => 'category', 'type' => 'text'));
        array_push($item_fields, (object) array('name' => 'platform', 'type' => 'text'));
        return $item_fields;
    }

    public function courseFieldsValues($item) {
        $item_values = [];
        array_push($item_values, (object) array('name' => 'title', 'type' => 'text', 'value' => $item->title));
        array_push($item_values, (object) array('name' => 'description', 'type' => 'text', 'value' => $item->description));
        array_push($item_values, (object) array('name' => 'image', 'type' => 'text', 'value' => $item->image));
        array_push($item_values, (object) array('name' => 'url', 'type' => 'text', 'value' => $item->url));
        array_push($item_values, (object) array('name' => 'price', 'type' => 'text', 'value' => $item->price));
        array_push($item_values, (object) array('name' => 'category', 'type' => 'text', 'value' => $item->category));
        array_push($item_values, (object) array('name' => 'platform', 'type' => 'text', 'value' => $item->platform));
        return $item_values;
    }
}
