<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Document>
 */
class DocumentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(),
            'summary' => $this->faker->sentence(),
            'is_active' => 1,
            'creator_id' => User::factory()->create()->id,
            'published_at' => now(),
        ];
    }

    public function inactive(): DocumentFactory
    {
        return $this->state(fn (array $attributes) => [
            'is_active' => 0,
        ]);
    }
}
