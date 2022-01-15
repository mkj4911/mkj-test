<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'information' => $this->faker->realText,
            'price' => $this->faker->numberBetween(1000, 50000),
            'is_selling' => $this->faker->numberBetween(0, 1),
            'sort_order' => $this->faker->randomNumber,
            'member_id' => $this->faker->numberBetween(1, 6),
            'secondary_category_id' => $this->faker->numberBetween(1, 6),
            'image1' => $this->faker->numberBetween(1, 57),
            'image2' => $this->faker->numberBetween(1, 57),
            'image3' => $this->faker->numberBetween(1, 57),
            'image4' => $this->faker->numberBetween(1, 57),
            'image5' => $this->faker->numberBetween(1, 57),
            'image6' => $this->faker->numberBetween(1, 57),
            'image7' => $this->faker->numberBetween(1, 57),
            'image8' => $this->faker->numberBetween(1, 57),
            'image9' => $this->faker->numberBetween(1, 57),
        ];
    }
}
