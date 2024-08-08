<?php

namespace AIGenerate\Models\Stock\Enums;

use App\Modules\Services\Enums\GetEnumAttributeTraits;

enum Gender: string
{
    use GetEnumAttributeTraits;

    case Male = 'male';
    case Female = 'female';
}
