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
            'course_id' => $this->faker->numberBetween(2, 204),
            'platform_id' => $this->faker->numberBetween(1, 5),
            'user_id' => $this->faker->numberBetween(2, 100),
            'title' => $this->faker->text(20),
            'review' => $this->faker->text(100),
            'rate' => $this->faker->numberBetween(1, 5)
        ];
    }
}
