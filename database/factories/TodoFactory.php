<?php


namespace Database\Factories;


use Faker\Factory;
use App\Models\User;

class TodoFactory extends \Illuminate\Database\Eloquent\Factories\Factory
{

    /**
     * @inheritDoc
     */
    public function definition()
    {
        // TODO: Implement definition() method.

        return [
            "title" => $this->faker->unique()->sentence(20),
            "description" => $this->faker->text(),
            "user_id" => User::factory()->create()->id
        ];
    }
}
