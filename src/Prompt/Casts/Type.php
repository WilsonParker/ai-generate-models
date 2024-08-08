<?php

namespace AIGenerate\Models\Prompt\Casts;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Database\Eloquent\Model;
use AIGenerate\Services\AI\OpenAI\Enums\OpenAITypes;

class Type implements CastsAttributes
{

    public function get(Model $model, string $key, mixed $value, array $attributes)
    {
        return OpenAITypes::from($model->prompt_type_code);
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
