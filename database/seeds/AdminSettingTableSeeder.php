<?php

use Illuminate\Database\Seeder;

use App\Model\AdminSetting;

class AdminSettingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $AdminSetting = new AdminSetting();
        $AdminSetting->name = 'allow_new_registration';
        $AdminSetting->value = '1';
        $AdminSetting->save();

        $this->command->info('Admin settings list created.');
    }
}
