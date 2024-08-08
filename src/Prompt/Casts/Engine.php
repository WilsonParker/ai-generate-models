<?php

namespace AIGenerate\Models\Prompt\Casts;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Database\Eloquent\Model;
use AIGenerate\Services\AI\OpenAI\Chat\Models;
use AIGenerate\Services\AI\OpenAI\Enums\OpenAITypes;
use AIGenerate\Services\AI\OpenAI\Images\ImageSize;

class Engine implements CastsAttributes
{

    public function get(Model $model, string $key, mixed $value, array $attributes)
    {
        $code = $model->prompt_engine_code;
        switch (OpenAITypes::from($model->prompt_type_code)) {
            case OpenAITypes::Image :
                return ImageSize::from($code);
            case OpenAITypes::Chat :
                return Models::from($code);
            case OpenAITypes::Completion:
                return \AIGenerate\Services\AI\OpenAI\Completion\Models::from($code);
        }
        return null;
    }

    public function set(Model $model, string $key, mixed $value, array $attributes)
    {
        if (is_string($value)) {
            return $value;
        } else {
            return $value->value;
        }
    }
}
