<?php

namespace AIGenerate\Models\Payment;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use AIGenerate\Models\BaseModel;
use AIGenerate\Models\User\User;

class PointHistory extends BaseModel
{
    use SoftDeletes, HasFactory;

    protected $with = ['type'];

    protected $table = 'point_history';

    public function type(): BelongsTo
    {
        return $this->belongsTo(PointType::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

}
