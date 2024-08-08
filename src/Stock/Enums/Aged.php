<?php

namespace AIGenerate\Models\Stock\Enums;

enum Aged: string
{
    case Low = 'low';
    case High = 'high';

    public function getValue(): float
    {
        return match ($this) {
            self::Low => 0.1,
            self::High => 0.5,
        };
    }
}
