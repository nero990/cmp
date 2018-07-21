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
        if(!$config_setting = collect(config('settings.core'))->where('key', $key)->first())
            throw new \Exception('Invalid Setting');

        if($setting = Setting::where('key', $key)->first()) return $setting->value;

        return $config_setting['default_val'];
    }

    public static function put($key, $value) {
        return Setting::updateOrCreate(
            ['key' => $key],
            ['key' => $key, 'value' => $value]
        );
    }
}
