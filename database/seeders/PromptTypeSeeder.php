<?php

namespace AIGenerate\Models\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;
use AIGenerate\Models\Prompt\PromptType;
use AIGenerate\Services\AI\OpenAI\Chat\Models;

class PromptTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $build = function (string $code, string $type = null, string $name = null, array $additional = []) {
            return array_merge([
                'code' => $code,
                'type' => $type,
                'name' => $name,
            ], $additional);
        };

        $buildEngine = function (array $enums) use ($build) {
            $result = [];
            foreach ($enums as $enum) {
                $result[] = $build($enum->value, $enum->value, $enum->value);
            }
            return $result;
        };

        $promptTypes[] = $build('image', 'image', 'DALL-E', [
            'engine' => [
                $build('default', 'image', 'default'),
            ],
        ]);

        $promptTypes[] = $build('chat', 'text', 'GPT CHAT', [
            'engine' => $buildEngine(Models::cases())
        ]);

        $promptTypes[] = $build('completion', 'text', 'GPT COMPLETION', [
            'engine' => $buildEngine(\AIGenerate\Services\AI\OpenAI\Completion\Models::cases()),
        ]);

        foreach ($promptTypes as $promptType) {
            $model = PromptType::firstOrCreate(Arr::only($promptType, ['code', 'type', 'name']));
            foreach ($promptType['engine'] as $engine) {
                $model->engines()->firstOrCreate(Arr::only($engine, ['code', 'name']));
            }
        }
    }
}
