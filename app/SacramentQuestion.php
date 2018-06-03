<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;

class SacramentQuestion extends Model implements AuditableContract
{
    use Auditable;

    protected $fillable = [
        'question'
    ];

    public function members() {
        return $this->belongsToMany(Member::class);
    }

    public function scopeEnabled($query) {
        return $query->whereIsEnabled(1);
    }

}