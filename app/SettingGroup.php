<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SettingGroup extends Model
{
    protected $fillable = ['setting_tab_id', 'name', 'icon'];

    //Relationships
    public function settings()
    {
        return $this->hasMany(Setting::class);
    }

    //Scopes
    public function scopeTab($query, $tab)
    {
        if ($tab != '') {
            return $query->where('setting_tab_id', $tab);
        }
    }

    /**
     * Method to search by any column
     * @param  Query $query
     * @param  string $target [description]
     * @return Query
     */
    public function scopeSearch($query, $target)
    {
        if ($target != '') {
            return $query->
                where('id', $target)
                ->orWhere('setting_tab_id', 'like', "%$target%")
                ->orWhere('name', 'like', "%$target%")
                ->orWhere('icon', 'like', "%$target%");
        }
    }
}
