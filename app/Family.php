<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Family extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name', 'registration_number', 'password', 'type', 'number_of_children', 'state_id', 'address', 'card_status', 'bcc_zone_id'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function bcc_zone() {
        return $this->belongsTo(BccZone::class);
    }

    public function members() {
        return $this->hasMany(Member::class);
    }
}
