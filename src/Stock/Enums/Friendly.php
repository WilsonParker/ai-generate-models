<?php

namespace AIGenerate\Models\Stock\Enums;

enum Friendly: string
{
    case Low = 'low';
    case High = 'high';

    public function getValue(): float
    {
        return match ($this) {
            self::Low => 0.75,
            self::High => 1.0,
        };
    }
}
