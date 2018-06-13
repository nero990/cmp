<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;

class MemberRole extends Model implements AuditableContract
{
    use Auditable;

    protected $fillable = [
        'name'
    ];

    public function members() {
        return $this->hasMany(Member::class);
    }

    public function scopeNotHead($query) {
        return $query->where('name', '<>', 'Head');
    }

    public static function getHead () {
        return optional(static::whereName('Head')->first())->id;
    }

    public static function getDependency () {
        return optional(static::whereName('Dependency')->first())->id;
    }

    public function getIsHeadAttribute() {
        return $this->attributes['name'] == "Head";
    }

}
