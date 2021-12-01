<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            //'category_id' => Category::factory(),
            'description' => $this->faker->sentence,
            'sku' => "{$this->faker->word}-".Str::random(4),
            'retail_price' => $this->faker->randomFloat(2,200,7500),
            'wholesale_price' => $this->faker->randomFloat(2,420,10400),
            'distributor_price' => $this->faker->randomFloat(2,100,6000),
        ];
    }
}
