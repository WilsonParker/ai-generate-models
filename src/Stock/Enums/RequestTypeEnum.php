<?php

namespace AIGenerate\Models\Stock\Enums;

enum RequestTypeEnum: string
{
    case Generate = 'generate';
    case Stock = 'stock';

    public function getQueue(): string
    {
        return match ($this) {
            self::Generate => 'ai-generate-image-generate',
            self::Stock => 'ai-generate-stock-image-generate',
        };
    }
}
