<?php

namespace Database\Factories;

use App\Models\RecommendationsRating;
use Illuminate\Database\Eloquent\Factories\Factory;

class RecommendationsRatingFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = RecommendationsRating::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'rec_id' => $this->faker->numberBetween(1,4),
            'user_id' => $this->faker->numberBetween(1, 100),
            'sentiment' => $this->faker->boolean(80)
        ];
    }
}
