<?php

namespace AIGenerate\Models\Prompt\Enums;

enum Status: string
{
    case Creating = 'creating';
    case Waiting = 'waiting';
    case Enabled = 'enabled';
    case Blocked = 'blocked';
    case Test = 'Test';
}
