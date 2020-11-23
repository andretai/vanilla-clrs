<?php

namespace App\Http\Controllers;

use App\Models\Rating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StatsController extends Controller
{
    public function index(Request $request) {
        $charts = [
            $this->byCategory('most favourites by category', SORT_DESC, '# of Favourites', null, 'favourites', 10, 'bar'),
            $this->byCategory('most ratings by category', SORT_DESC, '# of Ratings', null, 'ratings', 10, 'bar'),
            $this->byCategory('least favourites by category', SORT_ASC, '# of Favourites', null, 'favourites', 10, 'bar'),
            $this->byCategory('least ratings by category', SORT_ASC, '# of Ratings', null, 'ratings', 10, 'bar'),
            $this->byCategory('most positive ratings by category', SORT_DESC, '# of Ratings', '>', 'ratings', 10, 'bar'),
            $this->byCategory('most negative ratings by category', SORT_DESC, '# of Ratings', '<', 'ratings', 10, 'bar'),
            $this->proportion('courses per category', '# of Courses', 'categories', 'courses', 'pie'),
            $this->proportion('ratings per category', '# of Ratings', 'categories', 'ratings', 'pie')
        ];
        $col = $request->query('col');
        if($col === null) {
            $col = 2;
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

    public function proportion($name, $metric, $table, $table2, $type) {
        $categories = DB::table($table)->select('id')->get();
        $results = [];
        foreach ($categories as $category) {
            $count = DB::table($table2)->where('category_id', $category->id)->count();
            $category_name = DB::table($table)->where('id', $category->id)->first()->category;
            $metric = $metric;
            array_push($results, (object) array('subject' => $category_name, 'score' => $count, 'metric' => $metric));
        }
        $payload = (object) array(
            'name' => $name,
            'type' => $type,
            'data' => $this->data($results)
        );
        return $payload;
    }

    public function byCategory($name, $sort, $metric, $ops, $table, $number, $type) {
        $categories = DB::table('categories')->select('id')->get();
        $results = [];
        foreach ($categories as $category) {
            $category_courses = DB::table('courses')->where('category_id', $category->id)->get();
            $count = 0;
            foreach ($category_courses as $cat_course) {
                if($ops === null) {
                    $count += DB::table($table)->where('course_id', $cat_course->id)->count();
                }
            }
            if($ops !== null) {
                $count += DB::table('ratings')
                            ->where('category_id', $category->id)
                            ->where('rate', $ops, 3)
                            ->count();
            }
            $category_name = DB::table('categories')->where('id', $category->id)->first()->category;
            array_push($results, (object) array('subject' => $category_name, 'score' => $count, 'metric' => $metric));
        }
        $col = array_column($results, 'score');
        array_multisort($col, $sort, $results);
        $payload = (object) array(
            'name' => $name,
            'type' => $type,
            'data' => $this->data(array_slice($results, 0, $number))
        );
        return $payload;
    }
}
