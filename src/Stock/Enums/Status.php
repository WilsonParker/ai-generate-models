<?php

namespace AIGenerate\Models\Stock\Enums;

enum Status: string
{
    case Creating = 'creating';
    case Waiting = 'waiting';
    case Enabled = 'enabled';
    case Blocked = 'blocked';
    case Test = 'Test';
    case Adult = 'adult';
    case Medical = 'medical';
    case Spoof = 'spoof';
}
