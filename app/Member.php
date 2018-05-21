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

    const AGE_GROUP_LIST = [
        '1' => "16-20",
        '2' => "21-25",
        '3' => "26-30",
        '4' => "31-35",
        '5' => "36-40",
        '6' => "41-45",
        '7' => "46-50",
        '8' => "50 and above"
    ];

    const MARITAL_STATUS_LIST = [
        '1' => "Single",
        '2' => "Married",
        '3' => "Not Wedded",
        '4' => "Divorced",
        '5' => "Church Annulment",
        '6' => "Widowed"
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

    public function sacrament_details() {
        return $this->belongsToMany(SacramentDetail::class);
    }

    public function sick_member() {
        return $this->hasOne(SickMember::class);
    }

    public function getHead() {
        return $this->family->head;
    }

    public function getFullNameAttribute() {
        $middle_name = empty($this->attributes['middle_name']) ? $this->attributes['middle_name'] . " " : "";
        return $this->attributes['first_name'] . " {$middle_name}" . $this->attributes['last_name'];
    }

    public function getMaritalStatusAttribute() {
        return static::MARITAL_STATUS_LIST[$this->attributes['marital_status']];
    }

    public function getAgeGroupTextAttribute() {
        return static::AGE_GROUP_LIST[$this->attributes['age_group']];
    }


}