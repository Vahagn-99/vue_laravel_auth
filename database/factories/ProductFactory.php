<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
  /**
   * Define the model's default state.
   *
   * @return array<string, mixed>
   */
  public function definition()
  {
    return [
      'name' => $this->faker->word(),
      'imageSrc' => json_encode("https://source.unsplash.com/random/200x200?sig=" . rand(1, 5)),
      'imageAlt' => $this->faker->image,
      'price' => $this->faker->numberBetween(32, 50000),
      'color' => $this->faker->colorName
    ];
  }
}
