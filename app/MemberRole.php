<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableInterface;

class MemberRole extends Model implements AuditableInterface
{
    use Auditable;

    protected $fillable = [
        'name'
    ];

    public function members() {
        return $this->hasMany(Member::class);
    }


}
