<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableInterface;

class BccZone extends Model implements AuditableInterface
{
    use Auditable;

    protected $fillable = [
        'name', 'address'
    ];

    public function families() {
        return $this->hasMany(Family::class);
    }
}
