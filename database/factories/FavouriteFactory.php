<?php

namespace Database\Factories;

use App\Models\Favourite;
use Illuminate\Database\Eloquent\Factories\Factory;

class FavouriteFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Favourite::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => $this->faker->numberBetween(3, 102),
            'course_id' => $this->faker->numberBetween(2, 205)
        ];
    }
}
