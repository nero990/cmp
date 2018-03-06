<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MemberRole extends Model
{
    protected $fillable = [
        'name'
    ];

    public function members() {
        return $this->hasMany(Member::class);
    }


}
