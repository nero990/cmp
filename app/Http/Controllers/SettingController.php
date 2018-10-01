<?php

namespace App\Http\Controllers;

use App\Setting;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class SettingController extends Controller
{
    public function index()
    {
        $config_settings = config('settings.core');

        $settings = [];
        foreach ($config_settings AS $key => $config_setting) {
            try {
                $setting = Setting::get($config_setting['key']);

                $settings[] = [
                    'id' => $key,
                    'description' => $config_setting['description'],
                    'value' => isset($config_setting['options']) ? $config_setting['options'][$setting]: $setting,
                ];
            } catch (\Exception $e) {
            }
        }
        return view('admin.settings.index', compact('settings'));
    }

    public function edit($id)
    {
        $config_settings = config('settings.core');

        if(isset($config_settings[$id])){
            try {
                $config_setting = $config_settings[$id];

                $db_setting = Setting::get($config_setting['key']);

                $setting = [
                    'id' => $id,
                    'description' => $config_settings[$id]['description'],
                    'value' => $db_setting,
                    'options' => isset($config_setting['options']) ? $config_setting['options'] : null,
                ];

            } catch (\Exception $e) {
                dd($e->getMessage());
            }
            return view('admin.settings.edit', compact('setting'));
        }
        throw new NotFoundHttpException();
    }

    public function update(Request $request, $id)
    {
        $config_settings = config('settings.core');

        if(isset($config_settings[$id])){
            $this->validate($request, [
                'value' => $config_settings[$id]['validation']
            ]);

            Setting::put($config_settings[$id]['key'], $request->get('value'));

            alert()->success('Setting updated', "Great Job!");
            return back();

        }
        throw new NotFoundHttpException();

    }
}
