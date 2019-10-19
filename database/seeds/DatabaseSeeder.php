<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call(AdminSettingTableSeeder::class);
        $this->call(FeatureUsersTableSeeder::class);
    }
}
