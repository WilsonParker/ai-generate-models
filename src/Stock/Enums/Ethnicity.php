<?php

namespace AIGenerate\Models\Stock\Enums;

use App\Modules\Services\Enums\GetEnumAttributeTraits;

enum Ethnicity: string
{
    use GetEnumAttributeTraits;
    
    case African = 'african';
    case AfricanAmerican = 'african_american';
    case Black = 'black';
    case Brazilian = 'brazilian';
    case Chinese = 'chinese';
    case Caucasian = 'caucasian';
    case EastAsian = 'east_asian';
    case Hispanic = 'hispanic';
    case Japanese = 'japanese';
    case MiddleEastern = 'middle_eastern';
    case NativeAmerican = 'native_american';
    case PacificIslander = 'pacific_islander';
    case SouthAsian = 'south_asian';
    case SoutheastAsian = 'southeast_asian';
    case Other = 'other';
}
