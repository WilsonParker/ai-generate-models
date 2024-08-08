<?php

namespace AIGenerate\Models\Database\Factories\Prompt;

use Illuminate\Database\Eloquent\Factories\Factory;
use AIGenerate\Models\Prompt\PromptGenerate;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\AIGenerate\Models\Prompt\Prompt>
 */
class PromptGenerateFactory extends Factory
{

    public function modelName()
    {
        return PromptGenerate::class;
    }

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'order' => fake()->sentence,
            'max_tokens' => fake()->numberBetween(1, 128),
            'price' => fake()->numberBetween(1, 10),
            'template' => fake()->sentence,
            'seller_price' => fake()->numberBetween(1, 10),
            'input_price' => fake()->numberBetween(1, 10),
            'output_price' => fake()->numberBetween(1, 10),
        ];
    }
}
