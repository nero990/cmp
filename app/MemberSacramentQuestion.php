<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MemberSacramentQuestion extends Model
{
    protected $table = "member_sacrament_question";

    public function member() {
        return $this->belongsTo(Member::class);
    }
}
