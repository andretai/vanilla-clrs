<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Course;
use App\Models\Platform;
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
                $item_fields = app('App\Http\Controllers\PlatformsController')->platformFields([]);
                break;
            case 'category':
                $item_fields = app('App\Http\Controllers\CategoriesController')->categoryFields([]);
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
            case 'platform':
                $item = DB::table('platforms')->find($item_id);
                $item_fields = app('App\Http\Controllers\PlatformsController')->platformFieldsValues($item);
                break;
            case 'category':
                $item = DB::table('categories')->find($item_id);
                $item_fields = app('App\Http\Controllers\CategoriesController')->categoryFieldsValues($item);
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
        $platform = 'udemy';
        $files = Storage::disk('s3')->files('/udemy');
        $decoded_files = [];
        foreach ($files as $file) {
            array_push($decoded_files, json_decode(Storage::disk('s3')->get($file)));
        }
        // $test = [];
        foreach($decoded_files as $decoded_file) {
            foreach($decoded_file->courses as $course) {
                $category_id = DB::table('categories')->select('id')->where('category', $decoded_file->category)->first();
                $platform_id = DB::table('platforms')->select('id')->where('platform', $platform)->first();
                $request = new Request();
                $request->replace([
                    'title' => $course->title,
                    'description' => $course->headline,
                    'image' => $course->image_480x270,
                    'url' => $course->url,
                    'price' => $course->price,
                    'category_id' => $category_id->id,
                    'platform_id' => $platform_id->id
                ]);
                app('App\Http\Controllers\CoursesController')->store($request);
                // array_push($test, $platform_id);
            }
        }
        return dd(Course::all());
        // return dd($test);
    }

    public function indexCourse() {
        $courses = Course::all();
        return view('ms.pages.course', [
            'courses' => $courses
        ]);
    }

    public function indexPlatform() {
        $platforms = Platform::all();
        return view('ms.pages.platform', [
            'platforms' => $platforms
        ]);
    }

    public function indexCategory() {
        $categories = Category::all();
        return view('ms.pages.category', [
            'categories' => $categories
        ]);
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
