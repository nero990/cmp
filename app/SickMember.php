<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableInterface;

class SickMember extends Model implements AuditableInterface
{
    use Auditable;

    protected $fillable = [
        'sickness_name', 'sickness_nature'
    ];

    public function member() {
        return $this->belongsTo(Member::class);
    }
}
