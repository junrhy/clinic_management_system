<?php

use Illuminate\Database\Seeder;

use App\Model\Domain;

class DomainTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->command->info('Domain list seeded.');
    }
}
