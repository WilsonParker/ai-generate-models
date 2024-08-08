<?php

namespace AIGenerate\Models\Database\Seeders;

use Illuminate\Database\Seeder;
use AIGenerate\Models\Stock\Enums\ReviewTypes;
use AIGenerate\Models\Stock\StockReviewType;

class StockReviewTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $build = function (string $code, string $name): array {
            return [
                'code' => $code,
                'name' => $name,
            ];
        };

        collect(ReviewTypes::cases())->each(fn($item) => StockReviewType::create($build($item->value, $item->value)));
    }
}
