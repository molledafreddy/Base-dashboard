<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\SettingGroup;
use App\Events\Binnacles;
use Auth;

class SettingGroupController extends Controller
{
    
    public function index()
    {
        $setting_groups = SettingGroup::search(request()->search)
            ->orderBy(request()->orderBy, request()->desc == 'true' ? 'DESC' : 'ASC')
            ->paginate(5);
        return $setting_groups;
    }

    public function getSettingGroup($id)
    {
        return SettingGroup::find($id);
    }


    public function store()
    {
        $setting_group = SettingGroup::create(request()->all());
        // $setting_group->save();
        if ($setting_group->save()) {
            $data=[
                'ip' => request()->ip(),
                'action' => 'store', 
                'description' => 'Registro de un nuevo grupo de parametros', 
                'affected_table' => 'setting_groups',
                'query' => $setting_group,
                'user_id' => Auth::id(),
            ];
            event( new Binnacles($data));
        }

        return [
            'message' => trans('app.setting_group.store_message'),
            'id' => $setting_group->id,
        ];
    }

    public function update($id)
    {
        $setting_group = SettingGroup::find($id);
        $setting_group->fill(request()->all());

        if ($setting_group->save()) {
            $data=[
                'ip' => request()->ip(),
                'action' => 'Update', 
                'description' => 'Actualizacion un grupo de parametros', 
                'affected_table' => 'setting_groups',
                'query' => $setting_group,
                'user_id' => Auth::id(),
            ];
            event( new Binnacles($data));
        }

        return ['message' => trans('app.setting_group.update_message')];
    }

    public function delete($id)
    {
        $setting_group = SettingGroup::destroy($id);

        if ($setting_group) {
            $data=[
                'ip' => request()->ip(),
                'action' => 'Delete', 
                'description' => 'Eliminacion de grupo de parametros', 
                'affected_table' => 'setting_groups',
                'query' => $setting_group,
                'user_id' => Auth::id(),
            ];
            event( new Binnacles($data));
        }

        return ['message' => trans('app.setting_group.delete_message')];
    }
}
