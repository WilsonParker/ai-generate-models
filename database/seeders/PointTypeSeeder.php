<?php

namespace AIGenerate\Models\Database\Seeders;

use Illuminate\Database\Seeder;
use AIGenerate\Models\Payment\PointType;

class PointTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $build = function (string $code, string $description): array {
            return [
                'code' => $code,
                'description' => $description,
            ];
        };

        $items = [
            $build('plus', 'plus'),
            $build('minus', 'minus'),
        ];

        foreach ($items as $item) {
            PointType::create($item);
        }
    }
}
