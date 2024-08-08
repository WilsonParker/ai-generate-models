<?php

namespace AIGenerate\Models;

class BaseCodeModel extends BaseModel
{
    public $incrementing = false;
    protected $primaryKey = 'code';
    protected $keyType = 'string';

}
