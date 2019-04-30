<?php

namespace App;

use App\Custom\Traits\FileUpload;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Cache;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;

class BccZone extends Model implements AuditableContract
{
    use Auditable, FileUpload, SoftDeletes;

    protected $fillable = [
        'name', 'address', 'status', 'streets', 'uploaded_file_id'
    ];

    protected $casts = [
        'streets' => 'array'
    ];

    protected $appends = [
        'status_text'
    ];

    private static $size = 20;

    private static $required_headings = [
        'name', 'address', 'streets'
    ];

    const DONT_DISPLAY_AUDIT = ["id"];

    protected static function boot()
    {

        parent::boot(); // TODO: Change the autogenerated stub
        static::saved(function () {
            Cache::forget('bcc_zone_list');
        });

        static::deleted(function () {
            Cache::forget('bcc_zone_list');
        });
    }

    public function families() {
        return $this->hasMany(Family::class);
    }

    public function files() {
        return $this->belongsTo(UploadedFile::class);
    }

    public function scopeActive($query) {
        return $query->whereStatus('1');
    }

    public static function auditTransformer($attribute, $modified) {
        $modified = auditableJsonToString("streets", $attribute, $modified);
        $modified = auditableValueToText('status', static::class, $attribute, $modified);

        return $modified;
    }

    public static function getStatusText($status) {
        switch($status) {
            case "1" :
                return "Active";
            default :
                return "Inactive";
        }
    }

    public function getStatusTextAttribute() {
        return static::getStatusText($this->attributes['status']);
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
