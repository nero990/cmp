<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;

class Member extends Model implements AuditableContract
{
    use Auditable;

    protected $fillable = [
        'first_name', 'middle_name', 'last_name', 'email', 'phones', 'gender', 'age_group', 'member_role_id',
        'marital_status', 'occupation',
    ];

    protected $casts = [
        'phones' => 'array',
    ];

    public function church_engagements() {
        return $this->belongsToMany(ChurchEngagement::class);
    }

    public function family() {
        return $this->belongsTo(Family::class);
    }

    public function role() {
        return $this->belongsTo(MemberRole::class, 'member_role_id');
    }

    public function sick_member() {
        return $this->hasOne(SickMember::class);
    }

    public function scopeHead() {
        return $this->whereHas('role', function ($query) {
            $query->where('name', 'Head');
        })->first();
    }
}
