<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use OwenIt\Auditing\Models\Audit as ModelsAudit;

class Audit extends ModelsAudit
{
    /**
     * Get the User that owns the Audit
     */
    public function triggeredBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
