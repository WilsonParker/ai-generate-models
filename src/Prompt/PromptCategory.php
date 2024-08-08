<?php

namespace AIGenerate\Models\Prompt;

use Illuminate\Database\Eloquent\SoftDeletes;
use AIGenerate\Models\BaseModel;

class PromptCategory extends BaseModel
{
    use SoftDeletes;

    protected $table = 'prompt_categories';
}
