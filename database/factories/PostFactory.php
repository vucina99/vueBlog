<?php

namespace Database\Factories;

use App\Models\User;
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
        $users = User::pluck('id')->toArray();
        return [
            "user_id" => $this->faker->randomElement($users),
            "title" => $this->faker->realText(20),
            "description" =>  $this->faker->text($maxNbChars = 200) 
        ];
    }
}
