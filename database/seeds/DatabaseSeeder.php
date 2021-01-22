<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
    	$this->call(DomainTableSeeder::class);
        $this->call(AdminSettingTableSeeder::class);
        $this->call(FeatureUsersTableSeeder::class);
    }
}
