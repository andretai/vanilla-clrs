<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Course;
use App\Models\Platform;
use App\Models\Promotion;
use App\Models\Rating;
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
            case 'promotion':
                $item_fields = app('App\Http\Controllers\PromotionsController')->promotionFields([]);
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
            case 'promotion':
                $item = DB::table('promotions')->find($item_id);
                $item_fields = app('App\Http\Controllers\PromotionsController')->promotionFieldsValues($item);
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
        $file = Storage::get('courses_all.json');
        $decoded = json_decode($file);
        foreach ($decoded as $entry) {
            $category = DB::table('categories')->where('category', '=', $entry->category)->first();
            if($category === null) {
                $request = new Request();
                $request->replace([ 'category' => $entry->category, 'image' => '' ]);
                app('App\Http\Controllers\CategoriesController')->store($request);
                $category = DB::table('categories')->where('category', '=', $entry->category)->first();
            }
            $platform = DB::table('platforms')->where('platform', '=', $entry->platform)->first();
            if($platform === null) {
                $request = new Request();
                $request->replace([ 'platform' => $entry->platform ]);
                app('App\Http\Controllers\PlatformsController')->store($request);
                $platform = DB::table('platforms')->where('platform', '=', $entry->platform)->first();
            }
            $request = new Request();
            $request->replace([
                'platform_id' => $platform->id,
                'category_id' => $category->id,
                'external_id' => $entry->external_id,
                'title' => $entry->title,
                'description' => $entry->description,
                'instructor' => $entry->instructor,
                'image' => $entry->image,
                'price' => $entry->price,
                'url' => $entry->url
            ]);
            app('App\Http\Controllers\CoursesController')->store($request);
            $course = DB::table('courses')->where('external_id', '=', $entry->external_id)->first();
            foreach ($entry->reviews as $review) {
                $words = preg_split("/ /", $review->content);
                $title = join(" ", array_slice($words, 0, 5));
                // DB::table('ratings')->insert([
                //     'course_id' => $course->id,
                //     'category_id' => $category->id,
                //     'platform_id' => $platform->id,
                //     'user_id' => random_int(1, 100),
                //     'title' => $title,
                //     'review' => $review->content,
                //     'rate' => $review->rating
                // ]);
                $rating = new Rating;
                $rating->course_id = $course->id;
                $rating->category_id = $category->id;
                $rating->platform_id = $platform->id;
                $rating->user_id = random_int(1,100);
                $rating->title = $title;
                $rating->review = $review->content;
                $rating->rate = $review->rating;
                $rating->save();
            }
        }
        return dd("DONE");
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

    public function indexPromotion() {
        $promotions = Promotion::all();
        return view('ms.pages.promotion', [
            'promotions' => $promotions
        ]);
    }
}
