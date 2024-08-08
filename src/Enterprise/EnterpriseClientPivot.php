<?php

namespace AIGenerate\Models\Enterprise;

use AIGenerate\Models\BaseModel;

class EnterpriseClientPivot extends BaseModel
{
    protected $table = 'enterprise_client_pivots';

    public function enterprise(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Enterprise::class, 'enterprise_id');
    }

    public function client(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(EnterpriseClient::class, 'enterprise_client_id');
    }
}
