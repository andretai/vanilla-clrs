<?php

namespace Database\Factories;

use App\Models\Rating;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Storage;

class RatingFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Rating::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        static $count = 0;
        $file = Storage::get('transformed.json');
        $decoded = json_decode($file);
        $current = $count;
        $count++;
        return [
            'course_id' => $this->faker->numberBetween(1, 204),
            'platform_id' => 1,
            'user_id' => $this->faker->numberBetween(2, 101),
            'title' => $decoded[$current]->title,
            'review' => $decoded[$current]->review,
            'rate' => $this->faker->numberBetween(1, 5)
        ];
    }
}
