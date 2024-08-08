<?php

namespace AIGenerate\Models;

use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model
{
    protected $guarded = [];

    public function getWith(): array
    {
        return $this->with;
    }
}
