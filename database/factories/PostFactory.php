<?php

namespace Database\Factories;

use App\Models\Admin;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title'=>$this->faker->name,
            'description'=>$this->faker->realTextBetween(20, 50),
            'admin_id'=>Admin::all()->random()->id,
        ];
    }
}
