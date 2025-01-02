<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Ticket;
use App\Models\User;

class TicketFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Ticket::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(4),
            'description' => $this->faker->text(),
            'priority' => $this->faker->randomElement(["low","medium","high"]),
            'status' => $this->faker->randomElement(["open","closed","solved"]),
            'comment' => $this->faker->text(),
            'assigned_by' => User::factory(),
            'assigned_to' => User::factory(),
        ];
    }
}
