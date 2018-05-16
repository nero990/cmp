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
        switch ($this->attributes['marital_status']) {
            case '1' :
                return "Single";
            case '2' :
                return "Married";
            case '3' :
                return "Not Wedded";
            case '4' :
                return "Divorced";
            case '5' :
                return "Church Annulment";
            case '6' :
                return "Widowed";
        }
        return "";
    }

    public function getAgeGroupTextAttribute() {
        switch ($this->attributes['age_group']) {
            case '1' :
                return "0 - 10";
            case '2' :
                return "";
            case '3' :
                return "";
            case '4' :
                return "";
            case '5' :
                return "";
            case '6' :
                return "";
        }
        return "";
    }

}
