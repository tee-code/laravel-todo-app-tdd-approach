<?php


namespace Database\Factories;


use Faker\Factory;

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
            "description" => $this->faker->text()
        ];
    }
}
