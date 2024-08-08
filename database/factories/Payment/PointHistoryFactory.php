<?php

namespace AIGenerate\Models\Database\Factories\Payment;

use App\Services\Point\Enums\Types;
use Illuminate\Database\Eloquent\Factories\Factory;
use AIGenerate\Models\Payment\PointHistory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\AIGenerate\Models\User\User>
 */
class PointHistoryFactory extends Factory
{
    public function modelName()
    {
        return PointHistory::class;
    }

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $point = fake()->numberBetween(1, 100);
        return [
            'point_type_code' => collect(Types::cases())->random(1)->first()->value,
            'point' => fake()->numberBetween(1, 100),
            'remained' => fake()->numberBetween(0, $point),
            'description' => 'test',
        ];
    }

}
