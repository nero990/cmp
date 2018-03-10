<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;

class BccZone extends Model implements AuditableContract
{
    use Auditable;

    protected $fillable = [
        'name', 'address', 'streets'
    ];

    protected $casts = [
        'streets' => 'array'
    ];

    public function families() {
        return $this->hasMany(Family::class);
    }
}
