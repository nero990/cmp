<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;

class BccZone extends Model implements AuditableContract
{
    use Auditable;

    private static $size = 20;

    protected $fillable = [
        'name', 'address', 'status', 'streets'
    ];

    protected $casts = [
        'streets' => 'array'
    ];

    public function families() {
        return $this->hasMany(Family::class);
    }

    public function scopeActive($query) {
        return $query->whereStatus('1');
    }

    public function getStatusTextAttribute() {
        switch($this->attributes['status']) {
            case "1" :
                return "Active";
            default :
                return "Inactive";
        }
    }

    public function getPercentageSizeAttribute() {
        return ($this->families()->count() / static::$size) * 100 ."%";
    }

    public function getRandomPropertyAttribute() {
        $colors = ['fa-coffee' => 'green', 'fa-gamepad' => 'orange', 'fa-gift' => 'red', 'fa-trophy' => 'magenta'];
        $font_awesome = array_random(array_keys($colors));
        $colour = $colors[$font_awesome];

        return [
            'colour' => $colour,
            'font-awesome' => $font_awesome
        ];
    }
}
