<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;

class SacramentDetail extends Model implements AuditableContract
{
    use Auditable;

    protected $fillable = [ 'question', 'response_type' ];

    public static $response_type_list = [
        '1' => 'Yes/No',
        '2' => 'String'
    ];

    protected static function boot()
    {
        parent::boot(); // TODO: Change the autogenerated stub
    }

    public function getResponseTypeValueAttribute() {
        return static::$response_type_list[$this->attributes['response_type']];
    }
}
