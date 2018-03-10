<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;

class SacramentDetail extends Model implements AuditableContract
{
    use Auditable;

    protected $fillable = [
        'question',
        'response_type'
    ];
}
