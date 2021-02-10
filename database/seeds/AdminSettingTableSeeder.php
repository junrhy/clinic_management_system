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

        $AdminSetting = new AdminSetting();
        $AdminSetting->name = 'app_currency';
        $AdminSetting->value = 'PHP';
        $AdminSetting->save();

        $AdminSetting = new AdminSetting();
        $AdminSetting->name = 'app_currency_html_code';
        $AdminSetting->value = '&#8369;';
        $AdminSetting->save();

        $AdminSetting = new AdminSetting();
        $AdminSetting->name = 'bill_website_url';
        $AdminSetting->value = 'www.website.com';
        $AdminSetting->save();

        $AdminSetting = new AdminSetting();
        $AdminSetting->name = 'bill_facebook_page';
        $AdminSetting->value = 'facebook.com/pagename';
        $AdminSetting->save();

        $AdminSetting = new AdminSetting();
        $AdminSetting->name = 'bill_contact_numbers';
        $AdminSetting->value = '09260049848';
        $AdminSetting->save();

        $AdminSetting = new AdminSetting();
        $AdminSetting->name = 'bill_contact_email';
        $AdminSetting->value = 'jrcrodua@gmail.com';
        $AdminSetting->save();

        $AdminSetting = new AdminSetting();
        $AdminSetting->name = 'bill_contact_persons';
        $AdminSetting->value = 'Jun Rhy Crodua';
        $AdminSetting->save();

        $this->command->info('Admin settings list seeded.');
    }
}
