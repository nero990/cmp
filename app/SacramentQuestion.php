<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;

class SacramentQuestion extends Model implements AuditableContract
{
    use Auditable, SoftDeletes;

    protected $fillable = [
        'question', 'status'
    ];

    const DONT_DISPLAY_AUDIT = ["id"];

    public function members() {
        return $this->belongsToMany(Member::class);
    }

    public function scopeActive($query) {
        return $query->whereStatus('1');
    }

    public static function auditTransformer($attribute, $modified) {
        $modified = auditableValueToText('status', static::class, $attribute, $modified);

        return $modified;
    }

    public static function getStatusText($status) {
        switch($status) {
            case 1 :
                return "Active";
            default:
                return "Inactive";
        }
    }

    public function getStatusTextAttribute() {
        return static::getStatusText($this->attributes['status']);
    }

}
