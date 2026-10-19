<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Mattiverse\Userstamps\Traits\Userstamps;
use OwenIt\Auditing\Auditable as AuditingAuditable;
use OwenIt\Auditing\Contracts\Auditable;

class Group extends Model implements Auditable
{
    use AuditingAuditable, SoftDeletes, Userstamps;

    protected $fillable = [
        'name',
    ];
}
