<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;

class ChurchEngagement extends Model implements AuditableContract
{
    use Auditable;

    protected $fillable = [
        'name'
    ];

    const DONT_DISPLAY_AUDIT = ["id"];

    public function members() {
        return $this->belongsToMany(Member::class);
    }

    public static function auditTransformer($attribute, $modified) {
        return $modified;
    }

}
