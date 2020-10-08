<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

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
                $item_fields = app('App\Http\Controllers\CoursesController')->courseFields([]);     
                break;
            case 'platform':
                $item_fields = $this->platformFields($item_fields);
                break;
            case 'promo':
                $item_fields = $this->promoFields($item_fields);
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

    public function edit(Request $request) {
        $item_type = $request->query('item_type');
        $item_id = $request->query('id');
        $item_fields = [];
        switch($item_type) {
            case 'course':
                $item = DB::table('courses')->find($item_id);
                $item_fields = app('App\Http\Controllers\CoursesController')->courseFieldsValues($item);
                break;
            default:
                break;
        }
        return view('ms.api.edit', [
            'back' => route('ms-' . $item_type),
            'item_type' => $item_type,
            'item_id' => $item_id,
            'item_fields' => $item_fields
        ]);
    }

    public function remove(Request $request) {
        $item_type = $request->query('item_type');
        $item_id = $request->query('id');
        return view('ms.api.remove', [
            'item_type' => $item_type,
            'item_id' => $item_id
        ]);
    }

    public function seed() {
        $files = Storage::disk('s3')->files('/udemy');
        $decoded_files = [];
        foreach ($files as $file) {
            array_push($decoded_files, json_decode(Storage::disk('s3')->get($file)));
        }
        foreach($decoded_files as $decoded_file) {
            foreach($decoded_file->courses as $course) {
                $request = new Request();
                $request->replace([
                    'title' => $course->title,
                    'description' => $course->headline,
                    'image' => $course->image_480x270,
                    'url' => $course->url,
                    'price' => $course->price,
                    'category' => $decoded_file->category,
                    'platform' => 'udemy'
                ]);
                app('App\Http\Controllers\CoursesController')->store($request);
            }
        }
        return dd(Course::all());
    }

    public function indexCourse() {
        $courses = Course::all();
        return view('ms.pages.course', [
            'courses' => $courses
        ]);
    }

    public function platformFields($item_fields) {
        array_push($item_fields, (object) array('name' => 'title', 'type' => 'text'));
        array_push($item_fields, (object) array('name' => 'description', 'type' => 'text'));
        array_push($item_fields, (object) array('name' => 'image', 'type' => 'text'));
        array_push($item_fields, (object) array('name' => 'url', 'type' => 'text'));
        return $item_fields;
    }

    public function promoFields($item_fields) {
        array_push($item_fields, (object) array('name' => 'title', 'type' => 'text'));
        array_push($item_fields, (object) array('name' => 'description', 'type' => 'text'));
        array_push($item_fields, (object) array('name' => 'image', 'type' => 'text'));
        array_push($item_fields, (object) array('name' => 'start date', 'type' => 'date'));
        array_push($item_fields, (object) array('name' => 'end date', 'type' => 'date'));
        array_push($item_fields, (object) array('name' => 'url', 'type' => 'text'));
        return $item_fields;
    }
}
