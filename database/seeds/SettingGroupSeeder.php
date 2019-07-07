<?php

use App\SettingGroup;
use Illuminate\Database\Seeder;

class SettingGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SettingGroup::create([
            'setting_tab_id' => 1,
            'name' => 'Site Settings',
            'icon' => 'ti-world',
        ]);
        
        SettingGroup::create([
            'setting_tab_id' => 1,
            'name' => 'Color',
            'icon' => 'ti-world',
        ]);

        SettingGroup::create([
            'setting_tab_id' => 2,
            'name' => 'Logos',
            'icon' => 'ti-world',
        ]);

        

        // SettingGroup::create([
        //     'setting_tab_id' => 1,
        //     'name' => 'OpenGraph',
        //     'icon' => 'ti-pie-chart',
        // ]);





    }
}
