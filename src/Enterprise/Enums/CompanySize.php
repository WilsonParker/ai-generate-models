<?php

namespace AIGenerate\Models\Enterprise\Enums;

enum CompanySize: string
{
    case Between1And9     = 'between1And9';
    case Between10And49   = 'between10And49';
    case Between50And149  = 'between50And149';
    case Between150And249 = 'between150And249';
    case Between250And499 = 'between250And499';
    case Between500And999 = 'between500And999';
    case Over1000         = 'between1000And9999';

    public function getName(): string
    {
        return match ($this) {
            self::Between1And9 => '1~9',
            self::Between10And49 => '10~49',
            self::Between50And149 => '50~149',
            self::Between150And249 => '150~249',
            self::Between250And499 => '250~499',
            self::Between500And999 => '500~999',
            self::Over1000 => '1000~',
        };
    }
}