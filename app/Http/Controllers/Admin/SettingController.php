<?php

namespace App\Http\Controllers\Admin;

use App\Setting;
use App\SettingGroup;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Events\Binnacles;
use Carbon\Carbon;
use Auth;

class SettingController extends Controller
{
    public function index()
    {
        return SettingGroup::with('settings')
            ->tab(request()->tab)
            ->get();
    }

    public function store()
    {

        $storeValue = request()->value;
        if (count(request()->value)>0 && request()->type == 'image') {

            $Base64Img = $storeValue[0]['dataURL'];
            list(, $Base64Img) = explode(';', $Base64Img);
            list(, $Base64Img) = explode(',', $Base64Img);
            $Base64Img = base64_decode($Base64Img);

            $carbon = Carbon::now()->format('dmYHis');

            $imageUrl = $carbon.'.'.$storeValue[0]['upload']['filename'];

            $file = file_put_contents($imageUrl, $Base64Img);

            rename(public_path().'/'.$imageUrl,public_path().'/images/settings/'.$imageUrl);
       
            $storeValue = '/images/settings/'. $imageUrl;

        }

        $setting = new Setting();
        $setting->setting_group_id = request()->setting_group_id;
        $setting->param = request()->param;
        $setting->key = snake_case(request()->param);
        $setting->type = request()->type;
        $setting->options = request()->options;
        $setting->value = $storeValue;
        
        if ($setting->save()) {
            $data=[
                'ip' => request()->ip(),
                'action' => 'Store', 
                'description' => 'registro de un nuevo parametro de configuracion', 
                'affected_table' => 'Settings',
                'query' => $setting,
                'user_id' => Auth::id(),
            ];
            event( new Binnacles($data));
        }

        return [
            'message' => trans('app.setting.store_message'),
            'id' => $setting->id,
        ];
    }

    
    public function update($id)
    {
        $setting = Setting::find($id);
        $storeValue = request()->value;
        // return $storeValue[0]['dataURL'];
        if (count(request()->value)>0 && request()->type == 'image') {

            $Base64Img = $storeValue[0]['dataURL'];
            list(, $Base64Img) = explode(';', $Base64Img);
            list(, $Base64Img) = explode(',', $Base64Img);
            $Base64Img = base64_decode($Base64Img);

            $carbon = Carbon::now()->format('dmYHis');

            $imageUrl = $carbon.'.'.$storeValue[0]['upload']['filename'];

            $file = file_put_contents($imageUrl, $Base64Img);

            rename(public_path().'/'.$imageUrl,public_path().'/images/settings/'.$imageUrl);
       
            $storeValue = '/images/settings/'. $imageUrl;

        }

        $setting->setting_group_id = request()->setting_group_id;
        $setting->param = request()->param;
        $setting->key = snake_case(request()->param);
        $setting->type = request()->type;
        $setting->options = request()->options;
        $setting->value = $storeValue;
        
        if ($setting->save()) {
            $data=[
                'ip' => request()->ip(),
                'action' => 'Update', 
                'description' => 'Actualizacion de un parametro de configuracion', 
                'affected_table' => 'Settings',
                'query' => $setting,
                'user_id' => Auth::id(),
            ];
            event( new Binnacles($data));
        }

        return ['message' => trans('app.setting.update_message')];
    }

    public function delete($id)
    {
        $setting = Setting::destroy($id);

        if ($setting) {
            $data=[
                'ip' => request()->ip(),
                'action' => 'Delete', 
                'description' => 'Eliminacion de un parametro de configuracion', 
                'affected_table' => 'Settings',
                'query' => $setting,
                'user_id' => Auth::id(),
            ];
            event( new Binnacles($data));
        }


        return ['message' => trans('app.setting.delete_message')];
    }

    public function updateAll($id)
    {
        foreach (request()->payload['settings'] as $item) {
            $setting = Setting::find($item['id']);
            $setting->value = $item['value'];
            $setting->save();
        }

        // if ($setting) {
        //     $data=[
        //         'ip' => request()->ip();,
        //         'action' => 'update', 
        //         'description' => 'Actualizacion del parametro de configuracion', 
        //         'affected_table' => 'settings',
        //         'querry' => $setting,
        //         'user_id' => Auth::id(),
        //     ];
        //     event( new Binnacles($data));
        // }

        return ['message' => trans('app.setting.update_message')];
    }

    public function show($key)
    {
        return Setting::where('key', $key)->first();
    }

    public function color($key)
    {
        return Setting::where(['param' => 'Color', 'type' => 'list', 'key' => 'color' ])->first()->value;
    }
}
