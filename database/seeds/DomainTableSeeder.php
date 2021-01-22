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
        $domain = new Domain();
        $domain->client_id = 0;
        $domain->domain_name = 'domain.com';
        $domain->save();

        $this->command->info('Domain list seeded.');
    }
}
