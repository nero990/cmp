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
                $settings[] = [
                    'id' => $key,
                    'description' => $config_setting['description'],
                    'value' => Setting::get($config_setting['key']),
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
                $setting = [
                    'id' => $id,
                    'description' => $config_settings[$id]['description'],
                    'value' => Setting::get($config_settings[$id]['key']),
                ];
            } catch (\Exception $e) {
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

            flash()->success('Successful! Setting updated');
            return back();

        }
        throw new NotFoundHttpException();

    }
}
