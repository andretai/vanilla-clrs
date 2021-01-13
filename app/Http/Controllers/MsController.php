<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Course;
use App\Models\Mission;
use App\Models\Platform;
use App\Models\Promotion;
use App\Models\Rating;
use App\Models\User;
use Exception;
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
            case 'mission':
                $item_fields = app('\App\Http\Controllers\MissionsController')->missionFields([]);
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
            case 'mission':
                $item = DB::table('missions')->find($item_id);
                $item_fields = app('App\Http\Controllers\MissionsController')->missionFieldsValues($item);
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

    public function seed(Request $request) {
        $status = true;
        try {
            $platform = $request->query('platform');
            $fileName = 'courses_'.$platform.'.json';
            $file = Storage::get($fileName);
            $decoded = json_decode($file);
            $this->seedem($decoded);
        } catch(Exception $e) {
            error_log($e);
        }
        $platforms = Platform::all();
        $datasets = [];
        foreach ($platforms as $platform) {
            $fileName = 'courses_'.$platform->platform.'.json';
            $file = Storage::get($fileName);
            $decoded = json_decode($file);
            $datasets[$platform->platform] = (object) array('count'=>sizeof($decoded));
        }
        return view('ms.pages.settings.seed')
                ->with('platforms', $platforms)
                ->with('datasets', $datasets)
                ->with('status', $status);
    }

    public function seedem($decoded) {
        foreach ($decoded as $entry) {
            // If category doesn't exist, create new category.
            $category = DB::table('categories')->where('category', '=', $entry->category)->first();
            if($category === null) {
                $request = new Request();
                $request->replace([ 'category' => $entry->category, 'image' => $entry->image ?? '' ]);
                app('App\Http\Controllers\CategoriesController')->store($request);
                $category = DB::table('categories')->where('category', '=', $entry->category)->first();
            }
            // If platform doesn't exist, create new platform.
            $platform = DB::table('platforms')->where('platform', '=', $entry->platform)->first();
            if($platform === null) {
                $request = new Request();
                $request->replace([ 'platform' => $entry->platform ]);
                app('App\Http\Controllers\PlatformsController')->store($request);
                $platform = DB::table('platforms')->where('platform', '=', $entry->platform)->first();
            }
            // Package course as a request and send to the 'store' method of 'CoursesController'
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
            // Get the ID of the newly added course.
            $new_course = DB::table('courses')->orderBy('id', 'desc')->first();
            // Create records for 'ratings' table based on course's default ratings.
            $course = DB::table('courses')->where('id', '=', $new_course->id)->first();
            foreach ($entry->reviews as $review) {
                $words = preg_split("/ /", $review->content);
                $title = join(" ", array_slice($words, 0, 5));
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
        app('\App\Http\Controllers\SetsController')->createDescTags();
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

    public function indexMission() {
        $missions = Mission::all();
        return view('ms.pages.mission', [
            'missions' => $missions
        ]);
    }

    public function indexUser() {
        $users = User::all();
        return view('ms.pages.user')
                ->with('users', $users)
                ->with('message', '');
    }

    public function modUser(Request $request) {
        $user_id = $request->query('user_id');
        $is_admin = $request->query('is_admin');
        $message = '';
        if($is_admin) {
            DB::table('users')->where('id', $user_id)->update([
                'is_admin' => 0
            ]);
            $message = 'User '.$user_id.' has been un-modded.';
        } else {
            DB::table('users')->where('id', $user_id)->update([
                'is_admin' => 1
            ]);
            $message = 'User '.$user_id.' has been modded.';
        }
        return view('ms.pages.user')
                ->with('users', User::all())
                ->with('message', $message);
    }
}
