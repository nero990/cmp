<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UploadedFile extends Model
{
    protected $fillable = [
        'name', 'path', 'type'
    ];

    public function families() {
        return $this->hasMany(Family::class)->where('type', 'FAMILY');
    }

    public function bcc_zones() {
        return $this->hasMany(BccZone::class)->where('type', 'BCC_ZONE');
    }
}
