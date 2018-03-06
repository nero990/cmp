<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BccZone extends Model
{
    protected $fillable = [
        'name', 'address'
    ];

    public function families() {
        return $this->hasMany(Family::class);
    }
}
