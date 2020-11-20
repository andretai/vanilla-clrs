<?php

namespace App\Http\Controllers;

use App\Models\Rating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StatsController extends Controller
{
    public function index(Request $request) {
        $charts = [$this->mostRatedCategories(), $this->mostFavouritedCourses()];
        $col = $request->query('col');
        if($col === null) {
            $col = 3;
        }
        return view('ms.pages.stat')
            ->with('charts', $charts)
            ->with('col', $col);
    }

    public function data($params) {
        $labels = [];
        $data = [];
        $metric = '';
        foreach ($params as $param) {
            array_push($labels, $param->subject);
            array_push($data, $param->score);
            if($metric === '') {
                $metric = $param->metric;
            }
        }
        $results = (object) array(
            'labels' => $labels,
            'datasets' => (object) array(
                'label' => $metric,
                'data' => $data,
                'backgroundColor' => [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                ],
                'borderColor' => [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                'borderWidth' => 1
            )
        );
        return $results;
    }

    public function mostRatedCategories() {
        $categories = DB::table('ratings')->select('category_id')->distinct()->get();
        $results = [];
        foreach ($categories as $category) {
            $count = DB::table('ratings')->where('category_id', $category->category_id)->count();
            $category_name = DB::table('categories')->where('id', $category->category_id)->first()->category;
            $metric = '# of Ratings';
            array_push($results, (object) array('subject' => $category_name, 'score' => $count, 'metric' => $metric));
        }
        $col = array_column($results, 'score');
        array_multisort($col, SORT_DESC, $results);
        $payload = (object) array(
            'name' => 'most rated categories',
            'type' => 'bar',
            'data' => $this->data(array_slice($results, 0, 5))
        );
        return $payload;
    }

    public function mostFavouritedCourses() {
        $courses = DB::table('favourites')->select('course_id')->distinct()->get();
        $results = [];
        foreach ($courses as $course) {
            $count = DB::table('favourites')->where('course_id', $course->course_id)->count();
            $course_name = DB::table('courses')->where('id', $course->course_id)->first()->title;
            $metric = '# of Favourites';
            array_push($results, (object) array('subject' => $course_name, 'score' => $count, 'metric' => $metric));
        }
        $col = array_column($results, 'score');
        array_multisort($col, SORT_DESC, $results);
        $payload = (object) array(
            'name' => 'most favourited courses',
            'type' => 'pie',
            'data' => $this->data(array_slice($results, 0, 5))
        );
        return $payload;
    }
}
