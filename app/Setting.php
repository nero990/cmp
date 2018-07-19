<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{

    protected $fillable = ['key', 'value'];

    /**
     * @param $key
     * @return mixed
     * @throws \Exception
     */
    public static function get($key) {
        if(!$setting = Setting::where('key', $key)->first()) {
            if(!$setting = collect(config('settings.core'))->where('key', $key)->first())
                throw new \Exception('Invalid Setting');

            return $setting['default_val'];
        }
        return $setting->value;
    }

    public static function put($key, $value) {
        return Setting::updateOrCreate(
            ['key' => $key],
            ['key' => $key, 'value' => $value]
        );
    }
}
