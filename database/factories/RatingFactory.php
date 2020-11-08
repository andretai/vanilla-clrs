<?php

namespace Database\Factories;

use App\Models\Rating;
use Illuminate\Database\Eloquent\Factories\Factory;

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
        return [
            'course_id' => $this->faker->numberBetween(1, 204),
            'platform_id' => 1,
            'user_id' => $this->faker->numberBetween(2, 101),
            'title' => $this->faker->realText(50, 2),
            'review' => $this->faker->realText(200, 2),
            'rate' => $this->faker->numberBetween(1, 5)
        ];
    }
}
