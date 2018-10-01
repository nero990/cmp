<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UploadedFile extends Model
{
    protected $fillable = [
        'name', 'path', 'type', 'status', 'details'
    ];

    protected $casts = [
        'details' => 'object'
    ];

    public function families() {
        return $this->hasMany(Family::class);
    }

    public function bcc_zones() {
        return $this->hasMany(BccZone::class);
    }
}
