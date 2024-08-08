<?php

namespace AIGenerate\Models\Payment;

use Illuminate\Database\Eloquent\SoftDeletes;
use AIGenerate\Models\BaseModel;

class PointType extends BaseModel
{
    use SoftDeletes;

    protected $table = 'point_types';
}
