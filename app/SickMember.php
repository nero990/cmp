<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SickMember extends Model
{
    protected $fillable = [
        'sickness_name', 'sickness_nature'
    ];

    public function member() {
        return $this->belongsTo(Member::class);
    }
}
