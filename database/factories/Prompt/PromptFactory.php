<?php

namespace AIGenerate\Models\Database\Factories\Prompt;

use Illuminate\Database\Eloquent\Factories\Factory;
use AIGenerate\Models\Prompt\Enums\Status;
use AIGenerate\Models\Prompt\Prompt;
use AIGenerate\Models\Prompt\PromptType;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\AIGenerate\Models\Prompt\Prompt>
 */
class PromptFactory extends Factory
{

    public function modelName()
    {
        return Prompt::class;
    }

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $type = PromptType::with('engines')->inRandomOrder()->first();
        $status = collect(Status::cases())->random(1)->first();
        $engine = $type->engines->random(1)->first();
        return [
            'title' => fake()->sentence,
            'prompt_type_code' => $type->code,
            'prompt_status_code' => $status->value,
            'prompt_engine_code' => $engine->code,
            'price_per_generate' => fake()->numberBetween(1, 10),
            'description' => fake()->text,
            'template' => fake()->text,
            'user_id' => 2,
            'created_at' => fake()->dateTimeBetween('-1 month'),
        ];
    }
}
