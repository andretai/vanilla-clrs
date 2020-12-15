<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $file = Storage::get('transformed.json');
        // $decoded = json_decode($file);
        // \App\Models\User::factory(99)->create();
        // \App\Models\Rating::factory(sizeof($decoded))->create();
        // \App\Models\Favourite::factory(1000)->create();
        \App\Models\RecommendationsRating::factory(200)->create();
    }
}
