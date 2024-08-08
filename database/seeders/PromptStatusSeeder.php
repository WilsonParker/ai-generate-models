<?php

namespace AIGenerate\Models\Database\Seeders;

use Illuminate\Database\Seeder;
use AIGenerate\Models\Prompt\Enums\Status;
use AIGenerate\Models\Prompt\PromptStatus;

class PromptStatusSeeder extends Seeder
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

        collect(Status::cases())->each(fn($item) => PromptStatus::create($build($item->value, $item->value)));
    }
}
